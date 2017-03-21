<?php
class ControllerExtensionModuleUpdateprice extends Controller {
    public function index() {
        $this->load->language('extension/module/updateprice');

        //установка title
        $this->document->setTitle($this->language->get('heading_title'));

        //загрузка модели
        $this->load->model('setting/setting');

        //получаем текст в зависимости от языка
        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_edit'] = $this->language->get('text_edit');
        $data['text_yes'] = $this->language->get('text_yes');
        $data['text_no'] = $this->language->get('text_no');
        $data['text_enabled'] = $this->language->get('text_enabled');
        $data['text_disabled'] = $this->language->get('text_disabled');

        $data['entry_admin'] = $this->language->get('entry_admin');
        $data['entry_status'] = $this->language->get('entry_status');

        $data['button_save'] = $this->language->get('button_save');
        $data['button_cancel'] = $this->language->get('button_cancel');

        //создаем массив для хлебных крошек и получаем данные
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
            'href' => $this->url->link('extension/module/updateprice', 'token=' . $this->session->data['token'], true)
        );

        $filename = 'D:\OpenServer\OpenServer\open_cart\localhost\admin\controller\extension\module\products.csv';
        $handler = fopen($filename, 'r');
        //$content = fread($handler, filesize($filename));
        while(!feof($handler)){
            $content = fgets($handler, filesize($filename));
            if(empty($content)) continue;
            if(strpos($content, 'article') !== FALSE) continue;
            $productData = explode(';', $content);
            printf('<p>Товар %s с ценой %d в остатке %d', $productData[0], $productData[1], $productData[2]);
            //print $content;
            $products[] = $productData;
        }
        fclose($handler);
        //print $content;
        echo '<pre>';
        var_export($products);

        foreach ($products as $k => $p){
            $line = implode(';', $p);
            if($k < count($products)-1){
                $line = $line .PHP_EOL;
            }
            fwrite($handler, $line);
        }

        $filter_data = array(
            'sort' => 'name',
            'order' => 'ASC'
        );

        $this->load->model('catalog/product');
        $results = $this->model_catalog_product->getProducts($filter_data);

        //загружаем в массив data элементы страницы и передаем во view
        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('extension/module/updateprice', $data));
    }
}