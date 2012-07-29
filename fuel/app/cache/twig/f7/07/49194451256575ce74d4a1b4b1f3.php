<?php

/* app.twig */
class __TwigTemplate_f70749194451256575ce74d4a1b4b1f3 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
            'content' => array($this, 'block_content'),
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<html>

<body>

\t";
        // line 5
        if (isset($context["messages"])) { $_messages_ = $context["messages"]; } else { $_messages_ = null; }
        if ($_messages_) {
            // line 6
            echo "      <div class=\"message\">
         <ul>
         ";
            // line 8
            if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
            $context['_parent'] = (array) $context;
            $context['_seq'] = twig_ensure_traversable($_message_);
            foreach ($context['_seq'] as $context["_key"] => $context["message"]) {
                // line 9
                echo "            <li>";
                if (isset($context["message"])) { $_message_ = $context["message"]; } else { $_message_ = null; }
                echo $_message_;
                echo "</li>            
         ";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['message'], $context['_parent'], $context['loop']);
            $context = array_merge($_parent, array_intersect_key($context, $_parent));
            // line 11
            echo "         </ul>
      </div>
     ";
        }
        // line 14
        echo "
\t";
        // line 15
        $this->displayBlock('content', $context, $blocks);
        // line 18
        echo "
</body>

</html>";
    }

    // line 15
    public function block_content($context, array $blocks = array())
    {
        // line 16
        echo "
\t";
    }

    public function getTemplateName()
    {
        return "app.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  66 => 16,  63 => 15,  56 => 18,  54 => 15,  51 => 14,  46 => 11,  36 => 9,  31 => 8,  27 => 6,  24 => 5,  18 => 1,);
    }
}
