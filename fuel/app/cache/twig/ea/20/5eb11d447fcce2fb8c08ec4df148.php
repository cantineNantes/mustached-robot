<?php

/* stats.twig */
class __TwigTemplate_ea205eb11d447fcce2fb8c08ec4df148 extends Twig_Template
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
\t<h2>";
        // line 5
        echo Lang::get("mustached.checkin.stats.from");
        echo " ";
        if (isset($context["dates"])) { $_dates_ = $context["dates"]; } else { $_dates_ = null; }
        echo $this->getAttribute($_dates_, "start");
        echo " ";
        echo Lang::get("mustached.checkin.stats.to");
        echo " ";
        if (isset($context["dates"])) { $_dates_ = $context["dates"]; } else { $_dates_ = null; }
        echo $this->getAttribute($_dates_, "end");
        echo "</h2>


\t";
        // line 8
        if (isset($context["count"])) { $_count_ = $context["count"]; } else { $_count_ = null; }
        echo $this->getAttribute($_count_, "logs");
        echo " ";
        echo Lang::get("mustached.checkin.stats.passages");
        echo "

\t<br>

\t";
        // line 12
        if (isset($context["count"])) { $_count_ = $context["count"]; } else { $_count_ = null; }
        echo sprintf("%.2f", ($this->getAttribute($_count_, "users") / $this->getAttribute($_count_, "days")));
        echo " ";
        echo Lang::get("mustached.checkin.stats.passagesPerDay");
        echo "

\t<br>

\t";
        // line 16
        if (isset($context["count"])) { $_count_ = $context["count"]; } else { $_count_ = null; }
        echo $this->getAttribute($_count_, "users");
        echo " ";
        echo Lang::get("mustached.checkin.stats.differentPeople");
        echo "

\t<br>

\t<ul>
\t";
        // line 21
        if (isset($context["checkins"])) { $_checkins_ = $context["checkins"]; } else { $_checkins_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_checkins_);
        foreach ($context['_seq'] as $context["date"] => $context["number"]) {
            // line 22
            echo "\t\t<li>";
            if (isset($context["date"])) { $_date_ = $context["date"]; } else { $_date_ = null; }
            echo $_date_;
            echo " : ";
            if (isset($context["number"])) { $_number_ = $context["number"]; } else { $_number_ = null; }
            echo $_number_;
            echo " passages</li>
\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['date'], $context['number'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 24
        echo "\t</ul>



";
    }

    public function getTemplateName()
    {
        return "stats.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  95 => 24,  82 => 22,  77 => 21,  66 => 16,  56 => 12,  46 => 8,  32 => 5,  29 => 4,  26 => 3,);
    }
}
