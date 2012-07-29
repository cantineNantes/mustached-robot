<?php

/* headers/header_admin.html.twig */
class __TwigTemplate_51c420246965ad7738606817145730ee extends Twig_Template
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
        echo "
    <div class=\"navbar navbar-fixed-top\">
      <div class=\"navbar-inner\">
        <div class=\"container-fluid\">
          <a class=\"btn btn-navbar\" data-toggle=\"collapse\" data-target=\".nav-collapse\">
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
            <span class=\"icon-bar\"></span>
          </a>
          <!-- <a class=\"brand\" href=\"#\">Mustached Robot | Admin</a> -->
          <div class=\"nav-collapse\">
            <ul class=\"nav\">
              <li class=\"active dashboard\"><a href=\"";
        // line 13
        echo $this->env->getExtension('fuel')->url("admin");
        echo "\">
                <div class=\"navIcon\"></div>
                <span class=\"navText\">";
        // line 15
        echo Lang::get("mustached.admin.menu.home");
        echo "</span>
              </a></li>
              <li><a href=\"";
        // line 17
        echo $this->env->getExtension('fuel')->url("admin/checkin/stats");
        echo "\" class=\"statistics\">
                <div class=\"navIcon\"></div>
                <span class=\"navText\">";
        // line 19
        echo Lang::get("mustached.admin.menu.statistics");
        echo "</span>
              </a></li>
              <li><a href=\"";
        // line 21
        echo $this->env->getExtension('fuel')->url("admin/user");
        echo "\" class=\"coworkers\">
                <div class=\"navIcon\"></div>
                <span class=\"navText\">";
        // line 23
        echo Lang::get("mustached.admin.menu.coworkers");
        echo "</span>
              </a></li>
              <li><a href=\"#\" class=\"settings\">
                <div class=\"navIcon\"></div>
                <span class=\"navText\">";
        // line 27
        echo Lang::get("mustached.admin.menu.settings");
        echo "</span>
              </a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
";
    }

    public function getTemplateName()
    {
        return "headers/header_admin.html.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  63 => 27,  56 => 23,  51 => 21,  46 => 19,  41 => 17,  36 => 15,  31 => 13,  17 => 1,);
    }
}
