<?php

/**
 * Controller de déconnexion
 * @author Alexandra Habchi
 *
 */
class LogoutController extends Controller
{
    public function action()
    {
        $this->request->getSession()->unsetNamespace('user');
    }
}