<?php
class Controller {
    private $model;
    private $view;

    public function __construct($model, $view) {
        $this->model = $model;
        $this->view = $view;
    }

    public function handleAction($actionType) {
        switch ($actionType) {
            case 'rugir':
                $this->model->lutin->rugir($this->model->chevalier);
                break;
            case 'coupDesalete':
                $this->model->lutin->coupDesalete($this->model->chevalier);
                break;
            // Autres actions pour le lutin et autres personnages
        }

        // Mise à jour de la vue après l'action
        $this->updateView();
    }

    public function updateView() {
        $this->view->render($this->model);
    }
}
?>