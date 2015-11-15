<?php

/* /home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/plugins/quamis/pricemonitor/components/productdetails/default.htm */
class __TwigTemplate_740ddeb0d12ac1e2a8b4f62d36bbd22188b598f56c253d663e0f09942f179b09 extends Twig_Template
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
        echo "<div class=\"pricemonitor_details\">
\t<div class=\"row
\t\t";
        // line 3
        if ((twig_date_converter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "lastLog", array(), "method"), "updated_at", array())) > twig_date_converter($this->env, "-12hours"))) {
            // line 4
            echo "\t\t\tpricemonitor_product_current 
\t\t";
        } elseif ((twig_date_converter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute(        // line 5
(isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "lastLog", array(), "method"), "updated_at", array())) < twig_date_converter($this->env, "-2days"))) {
            // line 6
            echo "\t\t\tpricemonitor_product_old
\t\t";
        }
        // line 8
        echo "\t\">
\t\t<div class=\"col-md-6\">Last seen</div>
\t\t<div class=\"col-md-6 text-right \">";
        // line 10
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "lastLog", array(), "method"), "updated_at", array()), "M,d H:i"), "html", null, true);
        echo "</div>
\t</div>
\t<div class=\"row\">
\t\t<div class=\"col-md-6\">First seen</div>
\t\t<div class=\"col-md-6 text-right\">";
        // line 14
        echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "firstLog", array(), "method"), "created_at", array()), "M,d H:i"), "html", null, true);
        echo "</div>
\t</div>
\t
\t<div class=\"row\">
\t\t<div class=\"col-md-6\">Price min</div>
\t\t<div class=\"col-md-6 text-right pricemonitor_minPrice\">";
        // line 19
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "minPrice", array(), "method"), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "lastLog", array(), "method"), "currency", array()), "html", null, true);
        echo "</div>
\t</div>
\t<div class=\"row\">
\t\t<div class=\"col-md-6\">Price max</div>
\t\t<div class=\"col-md-6 text-right pricemonitor_maxPrice\">";
        // line 23
        echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "maxPrice", array(), "method"), 2, ".", ","), "html", null, true);
        echo " ";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "lastLog", array(), "method"), "currency", array()), "html", null, true);
        echo "</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "/home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/plugins/quamis/pricemonitor/components/productdetails/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  62 => 23,  53 => 19,  45 => 14,  38 => 10,  34 => 8,  30 => 6,  28 => 5,  25 => 4,  23 => 3,  19 => 1,);
    }
}
/* <div class="pricemonitor_details">*/
/* 	<div class="row*/
/* 		{% if date(__SELF__.product.lastLog().updated_at) > date('-12hours') %}*/
/* 			pricemonitor_product_current */
/* 		{% elseif date(__SELF__.product.lastLog().updated_at) < date('-2days') %}*/
/* 			pricemonitor_product_old*/
/* 		{% endif %}*/
/* 	">*/
/* 		<div class="col-md-6">Last seen</div>*/
/* 		<div class="col-md-6 text-right ">{{ __SELF__.product.lastLog().updated_at|date("M,d H:i") }}</div>*/
/* 	</div>*/
/* 	<div class="row">*/
/* 		<div class="col-md-6">First seen</div>*/
/* 		<div class="col-md-6 text-right">{{ __SELF__.product.firstLog().created_at|date("M,d H:i") }}</div>*/
/* 	</div>*/
/* 	*/
/* 	<div class="row">*/
/* 		<div class="col-md-6">Price min</div>*/
/* 		<div class="col-md-6 text-right pricemonitor_minPrice">{{ __SELF__.product.minPrice()|number_format(2, '.', ',') }} {{ __SELF__.product.lastLog().currency }}</div>*/
/* 	</div>*/
/* 	<div class="row">*/
/* 		<div class="col-md-6">Price max</div>*/
/* 		<div class="col-md-6 text-right pricemonitor_maxPrice">{{ __SELF__.product.maxPrice()|number_format(2, '.', ',') }} {{ __SELF__.product.lastLog().currency }}</div>*/
/* 	</div>*/
/* </div>*/
/* */
