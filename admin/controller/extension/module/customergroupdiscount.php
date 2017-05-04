<?php
class ControllerExtensionModuleCustomerGroupDiscount extends Controller{
    private $error = array();

    public function index() {
        $this->load->language('extension/module/customergroupdiscount');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('setting/setting');

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('customergroupdiscount', $this->request->post);

            $this->session->data['success'] = $this->language->get('text_success');

            $this->response->redirect($this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true));
        }

        $this->load->model('customer/customer_group');
        $data['customer_groups'] = $this->model_customer_customer_group->getCustomerGroups();


        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['entry_status'] = $this->language->get('entry_status');
        $data['group_user_name'] = $this->language->get('group_user_name');
        $data['sale_count'] = $this->language->get('sale_count');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = '';
        }

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_extension'),
            'href' => $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true)
        );

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('heading_title'),
            'href' => $this->url->link('extension/module/customergroupdiscount', 'token=' . $this->session->data['token'], true)
        );

        $data['action'] = $this->url->link('extension/module/customergroupdiscount', 'token=' . $this->session->data['token'], true);

        $data['cancel'] = $this->url->link('extension/extension', 'token=' . $this->session->data['token'] . '&type=module', true);

        if (isset($this->request->post['customergroupdiscount_status'])) {
            $data['customergroupdiscount_status'] = $this->request->post['customergroupdiscount_status'];
        } else {
            $data['customergroupdiscount_status'] = $this->config->get('customergroupdiscount_status');
        }

        if (isset($this->request->post['customergroupdiscount_groupid'])) {
            $data['customergroupdiscount_groupid'] = $this->request->post['customergroupdiscount_groupid'];
        } else {
            $data['customergroupdiscount_groupid'] = $this->config->get('customergroupdiscount_groupid');
        }

        if (isset($this->request->post['customergroupdiscount_discount'])) {
            $data['customergroupdiscount_discount'] = $this->request->post['customergroupdiscount_discount'];
        } else {
            $data['customergroupdiscount_discount'] = $this->config->get('customergroupdiscount_discount');
        }

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/customergroupdiscount', $data));
    }

    protected function validate() {
        if (!$this->user->hasPermission('modify', 'extension/module/customergroupdiscount')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }

        return !$this->error;
    }
}