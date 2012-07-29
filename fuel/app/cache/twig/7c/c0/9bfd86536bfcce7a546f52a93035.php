<?php

/* edit_password.twig */
class __TwigTemplate_7cc09bfd86536bfcce7a546f52a93035 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layouts/app.twig");

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doGetParent(array $context)
    {
        return "layouts/app.twig";
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $this->parent->display($context, array_merge($this->blocks, $blocks));
    }

    // line 3
    public function block_content($context, array $blocks = array())
    {
        // line 4
        echo "
<h2>";
        // line 5
        echo Lang::get("mustached.user.edit_password.title");
        echo "</h2>

";
        // line 7
        if (isset($context["form"])) { $_form_ = $context["form"]; } else { $_form_ = null; }
        echo $_form_;
        echo "

";
    }

    public function getTemplateName()
    {
        return "edit_password.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  37 => 7,  32 => 5,  29 => 4,  26 => 3,);
    }
}
