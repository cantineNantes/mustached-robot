<?php

/* admin.twig */
class __TwigTemplate_7fa8f7eaa167f0b8dd1cea02446c1e2d extends Twig_Template
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
        echo "\t<div class=\"row-fluid\">
\t\t<div class=\"span8\">
\t\t\t<h1>";
        // line 6
        echo Lang::get("mustached.checkin.admin.title");
        echo "</h1>
\t\t\t<div class=\"block\">
\t\t\t\t<div class=\"linkHolder\">
\t\t\t\t\t<a href=\"";
        // line 9
        echo $this->env->getExtension('fuel')->url("checkin/add");
        echo "\">";
        echo Lang::get("mustached.checkin.add_new");
        echo "</a>
\t\t\t\t</div>
\t\t\t\t<div class=\"dataHolder coworkersLog\">

\t\t\t\t\t";
        // line 13
        if (isset($context["checkins"])) { $_checkins_ = $context["checkins"]; } else { $_checkins_ = null; }
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($_checkins_);
        foreach ($context['_seq'] as $context["date"] => $context["checkin"]) {
            // line 14
            echo "
\t\t\t\t\t\t<div class=\"date dashed\">
\t\t\t\t\t\t\t<time datetime=\"";
            // line 16
            if (isset($context["date"])) { $_date_ = $context["date"]; } else { $_date_ = null; }
            echo $_date_;
            echo "\">";
            if (isset($context["date"])) { $_date_ = $context["date"]; } else { $_date_ = null; }
            echo twig_date_format_filter($this->env, $_date_, "d/m/Y");
            echo "</time>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<ul>
\t\t\t\t\t\t";
            // line 20
            if (isset($context["checkin"])) { $_checkin_ = $context["checkin"]; } else { $_checkin_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_checkin_);
            foreach ($context['_seq'] as $context["_key"] => $context["single_checkin"]) {
                // line 21
                echo "\t\t\t\t\t\t\t<li class=\"log\">
\t\t\t\t\t\t\t\t<img src=\"";
                // line 22
                if (isset($context["single_checkin"])) { $_single_checkin_ = $context["single_checkin"]; } else { $_single_checkin_ = null; }
                echo Mustached\Helper::avatar($this->getAttribute($_single_checkin_, "email"), 50);
                echo "\" class=\"avatar avatar-mini\"/>
\t\t\t\t\t\t\t\t<div class=\"logInfo\">
\t\t\t\t\t\t\t\t\t<a href=\"#\">";
                // line 24
                if (isset($context["single_checkin"])) { $_single_checkin_ = $context["single_checkin"]; } else { $_single_checkin_ = null; }
                echo $this->getAttribute($this->getAttribute($_single_checkin_, "user"), "name");
                echo "</a> ";
                echo Lang::get("admin.userCameFor");
                echo " ";
                if (isset($context["single_log"])) { $_single_log_ = $context["single_log"]; } else { $_single_log_ = null; }
                echo $this->getAttribute($_single_log_, "reason");
                echo " ";
                if (isset($context["single_checkin"])) { $_single_checkin_ = $context["single_checkin"]; } else { $_single_checkin_ = null; }
                if ((!$this->getAttribute($_single_checkin_, "killed"))) {
                    echo " - <a href=\"";
                    echo $this->env->getExtension('fuel')->url("checkin/admin/kill");
                    echo "/";
                    if (isset($context["single_checkin"])) { $_single_checkin_ = $context["single_checkin"]; } else { $_single_checkin_ = null; }
                    echo $this->getAttribute($_single_checkin_, "id");
                    echo "\">Kill</a> - ";
                }
                echo " <abbr class=\"timeago pull-right\" title=\"";
                if (isset($context["single_checkin"])) { $_single_checkin_ = $context["single_checkin"]; } else { $_single_checkin_ = null; }
                echo $this->getAttribute($_single_checkin_, "start");
                echo "\">";
                if (isset($context["single_checkin"])) { $_single_checkin_ = $context["single_checkin"]; } else { $_single_checkin_ = null; }
                echo $this->getAttribute($_single_checkin_, "time_ago");
                echo "</abbr>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</li>
\t\t\t\t\t\t";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['single_checkin'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 28
            echo "\t\t\t\t\t\t</ul>
\t\t\t\t\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['date'], $context['checkin'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
        // line 30
        echo "\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"span4\">
\t\t\t<h1>";
        // line 34
        echo Lang::get("mustached.checkin.admin.occupancy");
        echo "</h1>
\t\t\t<div class=\"block\">
\t\t\t\t<div class=\"dataHolder\">
\t\t\t\t\tBeau graphique
\t\t\t\t</div>
\t\t\t</div>
\t\t</div>
\t</div>
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
        return array (  127 => 34,  121 => 30,  114 => 28,  82 => 24,  76 => 22,  73 => 21,  68 => 20,  57 => 16,  53 => 14,  48 => 13,  39 => 9,  33 => 6,  29 => 4,  26 => 3,);
    }
}
