<?php

/* admin.twig */
class __TwigTemplate_871e1dd53db62fbb1bba669b581c91ed extends Twig_Template
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
        echo "\t<ul class=\"coworkersLog\">

\t";
        // line 6
        if (isset($context["users"])) { $_users_ = $context["users"]; } else { $_users_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_users_);
        foreach ($context['_seq'] as $context["_key"] => $context["user"]) {
            // line 7
            echo "\t\t\t<li class=\"log\">
\t\t\t\t<img src=\"";
            // line 8
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo Mustached\Helper::avatar($this->getAttribute($_user_, "email"), 50);
            echo "\" class=\"rounded\"/> ";
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo $this->getAttribute($_user_, "firstname");
            echo " ";
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo $this->getAttribute($_user_, "lastname");
            echo " (";
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo $this->getAttribute($_user_, "email");
            echo ") - <a href=\"";
            echo $this->env->getExtension('fuel')->url("user/account/edit");
            echo "/";
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            echo $this->getAttribute($_user_, "id");
            echo "\">";
            echo Lang::get("edit");
            echo "</a> - ";
            if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
            if ($this->getAttribute($_user_, "is_admin")) {
                echo " Admin - (<a href=\"";
                echo $this->env->getExtension('fuel')->url("admin/user/downgrade");
                echo "/";
                if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
                echo $this->getAttribute($_user_, "id");
                echo "\">";
                echo Lang::get("mustached.admin.downgrade");
                echo "</a>) ";
            } else {
                echo " <a href=\"";
                echo $this->env->getExtension('fuel')->url("admin/user/upgrade");
                echo "/";
                if (isset($context["user"])) { $_user_ = $context["user"]; } else { $_user_ = null; }
                echo $this->getAttribute($_user_, "id");
                echo "\">";
                echo Lang::get("mustached.admin.upgrade");
                echo "</a> ";
            }
            // line 9
            echo "\t\t\t</li>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['user'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 11
        echo "\t</ul>
";
    }

    public function getTemplateName()
    {
        return "admin.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  88 => 11,  81 => 9,  41 => 8,  38 => 7,  33 => 6,  29 => 4,  26 => 3,);
    }
}
