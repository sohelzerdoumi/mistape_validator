<?php

namespace MistapeValidator;

class Controller
{
    const ROUTES = [
        'default' => 'listMistapes'
    ];

    public function run()
    {
        $action = isset($_GET['action']) ? $_GET['action'] : 'default';

        if (!key_exists($action, self::ROUTES)) {
            $action = 'default';
        }

        call_user_func([$this, self::ROUTES[$action]]);
    }

    public function rejectMistape()
    {
        $mistapeId = intval($_POST['mistape-id']);
        $mistape   = MistapeDB::find($mistapeId);
        MistapeDB::updateStatus($mistape, Mistape::STATUS_REJECTED);

        $this->json(true);
    }

    public function acceptMistape()
    {
        $mistapeId = intval($_POST['mistape-id']);
        $mistape   = MistapeDB::find($mistapeId);
        $corrector = new MistapeCorrector($mistape);

        if (!$corrector->canAutoFix()) {
            $this->json('Correction impossible');
            return;
        }

        if (!$corrector->autofix()) {
            $this->json('Erreur durant la correction');
            return;
        }

        MistapeDB::updateStatus($mistape, Mistape::STATUS_ACCEPTED);

        $this->json(true);
    }

    protected function listMistapes()
    {
        $mistapes = MistapeDB::findAllPending();
        echo $this->render('list', [
            'mistapes' => $mistapes
        ]);
    }


    protected function json($data)
    {
        $message = json_encode($data);
        wp_die($message);
    }

    protected function render($template, $params = [])
    {
        extract($params);
        ob_start();
        include(MV_PATH_TEMPLATE . $template . '.php');
        return ob_get_clean();
    }
}