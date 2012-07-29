<?php

/* public.twig */
class __TwigTemplate_7f55fb9b9f993518e2e75c0c717a78cd extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = $this->env->loadTemplate("layouts/app.twig");

        $this->blocks = array(
            'title' => array($this, 'block_title'),
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
    public function block_title($context, array $blocks = array())
    {
    }

    // line 5
    public function block_content($context, array $blocks = array())
    {
        // line 6
        echo "
\t<h2>";
        // line 7
        echo Lang::get("calendar.nextEventsTitle");
        echo "</h2>

\t";
        // line 9
        if (isset($context["events"])) { $_events_ = $context["events"]; } else { $_events_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_events_);
        foreach ($context['_seq'] as $context["_key"] => $context["event"]) {
            // line 10
            echo "\t\t<h3>";
            if (isset($context["event"])) { $_event_ = $context["event"]; } else { $_event_ = null; }
            echo $this->getAttribute($_event_, "title");
            echo "</h3>
\t\t";
            // line 11
            echo Lang::get("stats.from");
            echo " ";
            if (isset($context["event"])) { $_event_ = $context["event"]; } else { $_event_ = null; }
            echo twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_event_, "when"), 0, array(), "array"), "start"), "d/m/Y");
            echo " ";
            echo Lang::get("stats.to");
            echo " ";
            if (isset($context["event"])) { $_event_ = $context["event"]; } else { $_event_ = null; }
            echo twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($_event_, "when"), 0, array(), "array"), "end"), "d/m/Y");
            echo "
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['event'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 13
        echo "
";
    }

    public function getTemplateName()
    {
        return "public.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  70 => 13,  54 => 11,  48 => 10,  43 => 9,  38 => 7,  35 => 6,  32 => 5,  27 => 3,);
    }
}
