<?php

/* /home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/plugins/quamis/pricemonitor/components/productlist/default.htm */
class __TwigTemplate_2be246ece8896e9d8801656f635eeabb112e05a62147cb7fed46b9f7d4a044c1 extends Twig_Template
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
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "products", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["product"]) {
            // line 2
            echo "\t";
            $context["mark"] = $this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "markedElements", array()), $this->getAttribute($context["product"], "id", array()), array(), "array");
            // line 3
            echo "\t<div class=\"row 
\t\tpricemonitor_list
\t\t";
            // line 5
            if ($this->getAttribute((isset($context["mark"]) ? $context["mark"] : null), "priceMin", array())) {
                echo "pricemonitor_list_priceMin";
            }
            echo " 
\t\t";
            // line 6
            if ($this->getAttribute((isset($context["mark"]) ? $context["mark"] : null), "priceMax", array())) {
                echo "pricemonitor_list_priceMax";
            }
            // line 7
            echo "\t\">
\t\t<a href=\"";
            // line 8
            echo $this->env->getExtension('CMS')->pageFilter("history", array("id" => $this->getAttribute($context["product"], "id", array())));
            echo "\"><div class=\"col-md-8\">";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["product"], "lastLog", array(), "method"), "name", array()), "html", null, true);
            echo "</div></a>
\t\t<div class=\"col-md-1\">";
            // line 9
            echo twig_escape_filter($this->env, $this->getAttribute($context["product"], "spider", array()), "html", null, true);
            echo "</div>
\t\t<div class=\"col-md-2 text-right col-price\">
\t\t\t";
            // line 11
            if (($this->getAttribute($context["product"], "minPrice", array(), "method") == $this->getAttribute($this->getAttribute($context["product"], "lastLog", array(), "method"), "price", array()))) {
                // line 12
                echo "\t\t\t\t<div class=\"pricemonitor_minPrice\">";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["product"], "lastLog", array(), "method"), "price", array()), 2, ".", ","), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["product"], "lastLog", array(), "method"), "currency", array()), "html", null, true);
                echo "</div>
\t\t\t";
            } elseif (($this->getAttribute(            // line 13
$context["product"], "maxPrice", array(), "method") == $this->getAttribute($this->getAttribute($context["product"], "lastLog", array(), "method"), "price", array()))) {
                // line 14
                echo "\t\t\t\t<div class=\"pricemonitor_maxPrice\">";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["product"], "lastLog", array(), "method"), "price", array()), 2, ".", ","), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["product"], "lastLog", array(), "method"), "currency", array()), "html", null, true);
                echo "</div>
\t\t\t";
            } else {
                // line 16
                echo "\t\t\t\t<div>";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, $this->getAttribute($this->getAttribute($context["product"], "lastLog", array(), "method"), "price", array()), 2, ".", ","), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["product"], "lastLog", array(), "method"), "currency", array()), "html", null, true);
                echo "</div>
\t\t\t";
            }
            // line 18
            echo "\t\t</div>
\t\t<div class=\"col-xl-1 text-right col-pricePerUM\">
\t\t\t";
            // line 20
            if ((($this->getAttribute($this->getAttribute($context["product"], "lastLog", array(), "method"), "price", array()) && $this->getAttribute($this->getAttribute($context["product"], "productAttributes", array(), "method"), "quantity", array())) && $this->getAttribute($this->getAttribute($this->getAttribute($context["product"], "productAttributes", array(), "method"), "quantity", array()), "value", array()))) {
                // line 21
                echo "\t\t\t\t";
                $context["pricePerUM"] = ($this->getAttribute($this->getAttribute($context["product"], "lastLog", array(), "method"), "price", array()) / $this->getAttribute($this->getAttribute($this->getAttribute($context["product"], "productAttributes", array(), "method"), "quantity", array()), "value", array()));
                // line 22
                echo "\t\t\t\t";
                echo twig_escape_filter($this->env, twig_number_format_filter($this->env, (isset($context["pricePerUM"]) ? $context["pricePerUM"] : null), 2, ".", ","), "html", null, true);
                echo " ";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($context["product"], "lastLog", array(), "method"), "currency", array()), "html", null, true);
                echo "/";
                echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($context["product"], "productAttributes", array(), "method"), "quantity_UM", array()), "value", array()), "html", null, true);
                echo "
\t\t\t";
            }
            // line 24
            echo "\t\t</div>
\t</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['product'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
    }

    public function getTemplateName()
    {
        return "/home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/plugins/quamis/pricemonitor/components/productlist/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  100 => 24,  90 => 22,  87 => 21,  85 => 20,  81 => 18,  73 => 16,  65 => 14,  63 => 13,  56 => 12,  54 => 11,  49 => 9,  43 => 8,  40 => 7,  36 => 6,  30 => 5,  26 => 3,  23 => 2,  19 => 1,);
    }
}
/* {% for product in __SELF__.products %}*/
/* 	{% set mark=__SELF__.markedElements[product.id] %}*/
/* 	<div class="row */
/* 		pricemonitor_list*/
/* 		{% if mark.priceMin %}pricemonitor_list_priceMin{% endif %} */
/* 		{% if mark.priceMax %}pricemonitor_list_priceMax{% endif %}*/
/* 	">*/
/* 		<a href="{{ 'history'|page({ id:product.id }) }}"><div class="col-md-8">{{ product.lastLog().name }}</div></a>*/
/* 		<div class="col-md-1">{{ product.spider }}</div>*/
/* 		<div class="col-md-2 text-right col-price">*/
/* 			{% if product.minPrice()==product.lastLog().price %}*/
/* 				<div class="pricemonitor_minPrice">{{ product.lastLog().price|number_format(2, '.', ',') }} {{ product.lastLog().currency }}</div>*/
/* 			{% elseif product.maxPrice()==product.lastLog().price %}*/
/* 				<div class="pricemonitor_maxPrice">{{ product.lastLog().price|number_format(2, '.', ',') }} {{ product.lastLog().currency }}</div>*/
/* 			{% else %}*/
/* 				<div>{{ product.lastLog().price|number_format(2, '.', ',') }} {{ product.lastLog().currency }}</div>*/
/* 			{% endif %}*/
/* 		</div>*/
/* 		<div class="col-xl-1 text-right col-pricePerUM">*/
/* 			{% if product.lastLog().price and product.productAttributes().quantity and product.productAttributes().quantity.value %}*/
/* 				{% set pricePerUM = (product.lastLog().price/product.productAttributes().quantity.value) %}*/
/* 				{{ pricePerUM|number_format(2, '.', ',') }} {{ product.lastLog().currency }}/{{ product.productAttributes().quantity_UM.value }}*/
/* 			{% endif %}*/
/* 		</div>*/
/* 	</div>*/
/* {% endfor %}*/
/* */
