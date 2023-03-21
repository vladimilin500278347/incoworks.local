<?php

class actionAdminContentItemTrashPut extends cmsAction {

    public function run($ctype_id) {

        $items = $this->request->get('selected', []);
        if (!$items) {
            cmsCore::error404();
        }

        if (!cmsForm::validateCSRFToken($this->request->get('csrf_token', ''))) {
            cmsCore::error404();
        }

        $ctype = $this->model_backend_content->getContentType($ctype_id);
        if (!$ctype) {
            return cmsCore::error404();
        }

        foreach ($items as $id) {

            if(!is_numeric($id)){
                continue;
            }

            $this->model_backend_content->toTrashContentItem($ctype['name'], $id);
        }

        $this->redirectBack();
    }

}
