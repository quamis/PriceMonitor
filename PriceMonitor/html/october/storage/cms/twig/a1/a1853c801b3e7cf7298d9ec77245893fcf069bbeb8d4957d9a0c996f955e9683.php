<?php

/* /home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/plugins/quamis/pricemonitor/components/productinfo/default.htm */
class __TwigTemplate_eeff28917fae98c49a8976f8fdedebc0cf83d58c67712a39883a5631e35bd330 extends Twig_Template
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
        if ($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "property", array(0 => "showTitle"), "method")) {
            // line 2
            echo "\t";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "lastLog", array(), "method"), "name", array()), "html", null, true);
            echo ", on <a href=\"";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "url", array()), "html", null, true);
            echo "\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "spider", array()), "html", null, true);
            echo "</a>
";
        }
        // line 4
        echo "
";
        // line 5
        if ($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "property", array(0 => "showPrice"), "method")) {
            // line 6
            echo "\t<div class=\"
\t\t";
            // line 7
            if (($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "lastLog", array(), "method"), "price", array()) == $this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "minPrice", array(), "method"))) {
                // line 8
                echo "\t\t\tpricemonitor_minPrice
\t\t";
            } elseif (($this->getAttribute($this->getAttribute($this->getAttribute(            // line 9
(isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "lastLog", array(), "method"), "price", array()) == $this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "maxPrice", array(), "method"))) {
                // line 10
                echo "\t\t\tpricemonitor_maxPrice
\t\t";
            }
            // line 12
            echo "\t\">";
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "lastLog", array(), "method"), "price", array()), 2, ".", ","), "html", null, true);
            echo " ";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "lastLog", array(), "method"), "currency", array()), "html", null, true);
            echo "</div>
";
        }
        // line 14
        echo "
";
    }

    public function getTemplateName()
    {
        return "/home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/plugins/quamis/pricemonitor/components/productinfo/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  58 => 14,  50 => 12,  46 => 10,  44 => 9,  41 => 8,  39 => 7,  36 => 6,  34 => 5,  31 => 4,  21 => 2,  19 => 1,);
    }
}
/* {% if __SELF__.property('showTitle') %}*/
/* 	{{ __SELF__.product.lastLog().name }}, on <a href="{{ __SELF__.product.url }}">{{ __SELF__.product.spider }}</a>*/
/* {% endif %}*/
/* */
/* {% if __SELF__.property('showPrice') %}*/
/* 	<div class="*/
/* 		{% if __SELF__.product.lastLog().price==__SELF__.product.minPrice() %}*/
/* 			pricemonitor_minPrice*/
/* 		{% elseif __SELF__.product.lastLog().price==__SELF__.product.maxPrice() %}*/
/* 			pricemonitor_maxPrice*/
/* 		{% endif %}*/
/* 	">{{ __SELF__.product.lastLog().price|number_format(2, '.', ',') }} {{ __SELF__.product.lastLog().currency }}</div>*/
/* {% endif %}*/
/* */
/* */
