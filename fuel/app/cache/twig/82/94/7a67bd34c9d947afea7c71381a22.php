<?php

/* headers/header_front.html.twig */
class __TwigTemplate_82947a67bd34c9d947afea7c71381a22 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "    <div class=\"navbar navbar-fixed-top\">
      <div class=\"navbar-inner\">
        <div class=\"container-fluid\">
          <a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\">
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
          </a>
          <!-- <a class=\"brand\" href=\"#\">Mustached Robot</a> -->
          <div class=\"nav-collapse\">
            <ul class=\"nav\">
              <li class=\"active\"><a href=\"";
        // line 12
        echo Uri::base("");
        echo "\">Check-in</a></li>
              <li><a href=\"";
        // line 13
        echo $this->env->getExtension('fuel')->url("user/account/add");
        echo "\">Créer mon compte</a></li>
              <li><a href=\"";
        // line 14
        echo $this->env->getExtension('fuel')->url("user/auth/login");
        echo "\">Connexion</a></li>
            </ul>
          </div><!--/.nav-collapse -->
          <div class=\"nav-collapse pull-right\">
            ";
        // line 18
        if (isset($context["current_user"])) { $_current_user_ = $context["current_user"]; } else { $_current_user_ = null; }
        if ($_current_user_) {
            // line 19
            echo "              ";
            if (isset($context["current_user"])) { $_current_user_ = $context["current_user"]; } else { $_current_user_ = null; }
            echo $this->getAttribute($_current_user_, "firstname");
            echo "
              <br>
              <a href=\"\">";
            // line 21
            echo Lang::get("user.editAccount");
            echo "</a>
              <a href=\"";
            // line 22
            echo $this->env->getExtension('fuel')->url("user/auth/logout");
            echo "\">Déconnexion</a>
              <br>
              <a href=\"";
            // line 24
            echo $this->env->getExtension('fuel')->url("user/account/edit_password");
            echo "\">Changer mdp</a>
            ";
        }
        // line 26
        echo "          </div>
        </div>
      </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "headers/header_front.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  69 => 26,  64 => 24,  59 => 22,  55 => 21,  48 => 19,  45 => 18,  38 => 14,  34 => 13,  30 => 12,  17 => 1,);
    }
}
