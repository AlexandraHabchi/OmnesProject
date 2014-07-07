<?php

/**
 * Controller de déconnexion
 * @author Formateur
 *
 */
class LogoutController extends Controller
{
    public function action()
    {
        $this->request->getSession()->unsetNamespace('user');
    }
}