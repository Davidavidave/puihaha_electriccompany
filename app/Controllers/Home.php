<?php

namespace App\Controllers;

use App\Models\CustomerAccountModel;

class Home extends BaseController
{
    protected $customerModel;

    public function __construct() { $this->customerModel = new CustomerAccountModel(); }

    private function requireLogin()
    {
        return session()->get('isLogged') === true ? null : redirect()->to('/login');
    }

    public function index()
    {
        if ($redirect = $this->requireLogin()) return $redirect;
        $keyword = $this->request->getGet('search');
        $status = $this->request->getGet('status');
        $type = $this->request->getGet('type');
        $perPage = 10;
        if ($keyword) $accounts = $this->customerModel->searchAccounts($keyword, $perPage);
        elseif ($status) $accounts = $this->customerModel->getAccountsByStatus($status, $perPage);
        elseif ($type) $accounts = $this->customerModel->getAccountsByType($type, $perPage);
        else $accounts = $this->customerModel->getAccountsPaginated($perPage);
        return view('home/index', [
            'accounts' => $accounts, 'pager' => $this->customerModel->pager,
            'total_accounts' => $this->customerModel->getTotalAccounts(),
            'active_accounts' => $this->customerModel->getCountByStatus('active'),
            'inactive_accounts' => $this->customerModel->getCountByStatus('inactive'),
            'suspended_accounts' => $this->customerModel->getCountByStatus('suspended'),
            'current_page' => $this->request->getGet('page') ?? 1,
            'search_keyword' => $keyword, 'filter_status' => $status, 'filter_type' => $type,
            'username' => session()->get('username'),
        ]);
    }

    public function viewAccount($id)
    {
        if ($redirect = $this->requireLogin()) return $redirect;
        $account = $this->customerModel->find($id);
        if (! $account) return redirect()->to('/dashboard')->with('error', 'Account not found.');
        return view('home/view_account', ['account' => $account, 'username' => session()->get('username')]);
    }

    public function create()
    {
        if ($redirect = $this->requireLogin()) return $redirect;
        return view('home/form', ['account' => null, 'title' => 'Add Customer Account']);
    }

    public function store()
    {
        if ($redirect = $this->requireLogin()) return $redirect;
        if (! $this->validate($this->rules())) return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        $this->customerModel->insert($this->accountData());
        return redirect()->to('/dashboard')->with('success', 'Customer account added successfully.');
    }

    public function edit($id)
    {
        if ($redirect = $this->requireLogin()) return $redirect;
        $account = $this->customerModel->find($id);
        if (! $account) return redirect()->to('/dashboard')->with('error', 'Account not found.');
        return view('home/form', ['account' => $account, 'title' => 'Edit Customer Account']);
    }

    public function update($id)
    {
        if ($redirect = $this->requireLogin()) return $redirect;
        if (! $this->validate($this->rules($id))) return redirect()->back()->withInput()->with('error', implode(' ', $this->validator->getErrors()));
        $this->customerModel->update($id, $this->accountData());
        return redirect()->to('/dashboard')->with('success', 'Customer account updated successfully.');
    }

    public function delete($id)
    {
        if ($redirect = $this->requireLogin()) return $redirect;
        $this->customerModel->delete($id);
        return redirect()->to('/dashboard')->with('success', 'Customer account deleted successfully.');
    }

    private function accountData(): array
    {
        return $this->request->getPost(['account_number', 'customer_name', 'address', 'phone', 'email', 'meter_number', 'connection_type', 'status']);
    }

    private function rules(?int $id = null): array
    {
        $unique = $id ? "is_unique[customer_accounts.account_number,id,{$id}]" : 'is_unique[customer_accounts.account_number]';
        return ['account_number' => "required|max_length[50]|{$unique}", 'customer_name' => 'required|max_length[150]', 'address' => 'required', 'email' => 'permit_empty|valid_email|max_length[100]', 'connection_type' => 'required|in_list[residential,commercial,industrial]', 'status' => 'required|in_list[active,inactive,suspended]'];
    }
}
