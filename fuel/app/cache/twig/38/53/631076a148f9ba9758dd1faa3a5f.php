<?php

/* layouts/app.twig */
class __TwigTemplate_3853631076a148f9ba9758dd1faa3a5f extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'title' => array($this, 'block_title'),
            'msg' => array($this, 'block_msg'),
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<!DOCTYPE html>
<html lang=\"en\">
  <head>
    <meta charset=\"utf-8\">
    <title>";
        // line 5
        $this->displayBlock('title', $context, $blocks);
        echo "</title>
    <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">
    <meta name=\"description\" content=\"\">
    <meta name=\"author\" content=\"\">

    <!-- Le styles -->

    ";
        // line 12
        if (isset($context["stylesheet"])) { $_stylesheet_ = $context["stylesheet"]; } else { $_stylesheet_ = null; }
        echo $_stylesheet_;
        echo "

    <link href=\"http://mustached.fuel/assets/css/autoSuggest.css\" rel=\"stylesheet\">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src=\"http://html5shim.googlecode.com/svn/trunk/html5.js\"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel=\"shortcut icon\" href=\"../assets/ico/favicon.ico\">
    <link rel=\"apple-touch-icon-precomposed\" sizes=\"144x144\" href=\"../assets/ico/apple-touch-icon-144-precomposed.png\">
    <link rel=\"apple-touch-icon-precomposed\" sizes=\"114x114\" href=\"../assets/ico/apple-touch-icon-114-precomposed.png\">
    <link rel=\"apple-touch-icon-precomposed\" sizes=\"72x72\" href=\"../assets/ico/apple-touch-icon-72-precomposed.png\">
    <link rel=\"apple-touch-icon-precomposed\" href=\"../assets/ico/apple-touch-icon-57-precomposed.png\">
  </head>

  <body id=\"";
        // line 29
        if (isset($context["section"])) { $_section_ = $context["section"]; } else { $_section_ = null; }
        echo $_section_;
        echo "\">



     ";
        // line 33
        if (isset($context["section"])) { $_section_ = $context["section"]; } else { $_section_ = null; }
        $template = $this->env->resolveTemplate((("headers/header_" . $_section_) . ".html.twig"));
        $template->display($context);
        // line 34
        echo "
    <div class=\"container-fluid\">

        ";
        // line 37
        $this->displayBlock('msg', $context, $blocks);
        // line 50
        echo "
        ";
        // line 51
        $this->displayBlock('content', $context, $blocks);
        // line 54
        echo "
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->

    <link href=\"http://mustached.fuel/assets/css/autoSuggest.css\" rel=\"stylesheet\">

    ";
        // line 63
        echo Asset::js("jquery-1.7.2.min.js");
        echo "
    ";
        // line 64
        echo Asset::js("jquery.autocomplete-min.js");
        echo "
    ";
        // line 65
        echo Asset::js("jquery.timeago.js");
        echo "
    ";
        // line 66
        echo Asset::js("common.js");
        echo "
    ";
        // line 67
        echo Asset::js("bootstrap.js");
        echo "

  </body>
</html>
";
    }

    // line 5
    public function block_title($context, array $blocks = array())
    {
        echo "Mustached Robot";
    }

    // line 37
    public function block_msg($context, array $blocks = array())
    {
        // line 38
        echo "          ";
        if (isset($context["msg"])) { $_msg_ = $context["msg"]; } else { $_msg_ = null; }
        if ($_msg_) {
            // line 39
            echo "
          <div class=\"row-fluid\">
            <div class=\"span12\">
              <div id=\"message\" class=\"alert alert-";
            // line 42
            if (isset($context["msg"])) { $_msg_ = $context["msg"]; } else { $_msg_ = null; }
            echo $this->getAttribute($_msg_, "type");
            echo " clearfix\">
                <div class=\"icoMessage pull-left\"></div>
                <div class=\"messages span11\">";
            // line 44
            if (isset($context["msg"])) { $_msg_ = $context["msg"]; } else { $_msg_ = null; }
            echo $this->getAttribute($_msg_, "content");
            echo "</div>
              </div>
            </div>
          </div>
          ";
        }
        // line 49
        echo "        ";
    }

    // line 51
    public function block_content($context, array $blocks = array())
    {
        // line 52
        echo "
        ";
    }

    public function getTemplateName()
    {
        return "layouts/app.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  157 => 52,  154 => 51,  150 => 49,  141 => 44,  135 => 42,  130 => 39,  126 => 38,  123 => 37,  117 => 5,  108 => 67,  104 => 66,  100 => 65,  96 => 64,  92 => 63,  81 => 54,  79 => 51,  76 => 50,  74 => 37,  69 => 34,  65 => 33,  57 => 29,  36 => 12,  26 => 5,  20 => 1,);
    }
}
