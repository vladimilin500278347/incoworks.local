<?php

class actionFormsDelete extends cmsAction {

    public function run($id) {

        if (!cmsForm::validateCSRFToken($this->request->get('csrf_token', ''))){
            cmsCore::error404();
        }

        $form_data = $this->model->getForm($id);
        if(!$form_data){ cmsCore::error404(); }

        $this->model->deleteForm($id);

        cmsUser::addSessionMessage(LANG_DELETE_SUCCESS, 'success');

        $this->redirectToAction('');

    }

}
