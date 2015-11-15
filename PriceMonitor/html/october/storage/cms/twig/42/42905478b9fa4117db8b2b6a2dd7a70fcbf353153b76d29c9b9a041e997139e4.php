<?php

/* /home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/plugins/quamis/pricemonitor/components/producthistory/default.htm */
class __TwigTemplate_24a4d9d73e05d8e61762a182bd1a5d53f3a964144244e22e48a7ea44c33950a2 extends Twig_Template
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
        echo "<div class=\"pricemonitor_history\">
\t";
        // line 2
        $context["lastLog"] = null;
        // line 3
        echo "\t";
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "getLogs", array(), "method"));
        foreach ($context['_seq'] as $context["_key"] => $context["log"]) {
            // line 4
            echo "\t\t";
            $context["diff"] = 0;
            // line 5
            echo "\t\t";
            if ((isset($context["lastLog"]) ? $context["lastLog"] : null)) {
                // line 6
                echo "\t\t\t";
                $context["diff"] = ($this->getAttribute($context["log"], "price", array()) - $this->getAttribute((isset($context["lastLog"]) ? $context["lastLog"] : null), "price", array()));
                // line 7
                echo "\t\t";
            }
            // line 8
            echo "
\t\t<div class=\"row ";
            // line 9
            if ((isset($context["lastLog"]) ? $context["lastLog"] : null)) {
                if (((isset($context["diff"]) ? $context["diff"] : null) > 0)) {
                    echo "pricemonitor_minPrice";
                } else {
                    echo "pricemonitor_maxPrice";
                }
            }
            echo "\">
\t\t\t<div class=\"col-md-6\">";
            // line 10
            echo twig_escape_filter($this->env, twig_date_format_filter($this->env, $this->getAttribute($context["log"], "updated_at", array()), "M,d H:i"), "html", null, true);
            echo "</div>
\t\t\t<div class=\"col-md-3 text-right text-nowrap\">";
            // line 11
            echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($context["log"], "price", array()), 2, ".", ","), "html", null, true);
            echo "</div>
\t\t\t<div class=\"col-md-3 text-right hidden-sm\"><small><em>
\t\t\t\t";
            // line 13
            if ((isset($context["lastLog"]) ? $context["lastLog"] : null)) {
                // line 14
                echo "\t\t\t\t\t";
                if (((isset($context["diff"]) ? $context["diff"] : null) > 0)) {
                    echo "+";
                }
                // line 15
                echo "\t\t\t\t\t";
                if (((isset($context["diff"]) ? $context["diff"] : null) < 0)) {
                    echo "-";
                }
                // line 16
                echo "\t\t\t\t\t";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, abs((isset($context["diff"]) ? $context["diff"] : null)), 1, ".", ","), "html", null, true);
                echo "
\t\t\t\t";
            }
            // line 18
            echo "\t\t\t</em></small></div>
\t\t</div>
\t\t";
            // line 20
            $context["lastLog"] = $context["log"];
            // line 21
            echo "\t";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['log'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 22
        echo "</div>
";
    }

    public function getTemplateName()
    {
        return "/home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/plugins/quamis/pricemonitor/components/producthistory/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  93 => 22,  87 => 21,  85 => 20,  81 => 18,  75 => 16,  70 => 15,  65 => 14,  63 => 13,  58 => 11,  54 => 10,  44 => 9,  41 => 8,  38 => 7,  35 => 6,  32 => 5,  29 => 4,  24 => 3,  22 => 2,  19 => 1,);
    }
}
/* <div class="pricemonitor_history">*/
/* 	{% set lastLog = null %}*/
/* 	{% for log in __SELF__.product.getLogs() %}*/
/* 		{% set diff = 0 %}*/
/* 		{% if lastLog %}*/
/* 			{% set diff = (log.price - lastLog.price) %}*/
/* 		{% endif %}*/
/* */
/* 		<div class="row {% if lastLog %}{% if diff>0 %}pricemonitor_minPrice{% else %}pricemonitor_maxPrice{% endif %}{% endif %}">*/
/* 			<div class="col-md-6">{{ log.updated_at|date("M,d H:i") }}</div>*/
/* 			<div class="col-md-3 text-right text-nowrap">{{ log.price|number_format(2, '.', ',') }}</div>*/
/* 			<div class="col-md-3 text-right hidden-sm"><small><em>*/
/* 				{% if lastLog %}*/
/* 					{% if diff>0 %}+{% endif %}*/
/* 					{% if diff<0 %}-{% endif %}*/
/* 					{{ diff|abs|number_format(1, '.', ',') }}*/
/* 				{% endif %}*/
/* 			</em></small></div>*/
/* 		</div>*/
/* 		{% set lastLog = log %}*/
/* 	{% endfor %}*/
/* </div>*/
/* */
