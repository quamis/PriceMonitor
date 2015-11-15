<?php

/* /home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/plugins/quamis/pricemonitor/components/productcategories/default.htm */
class __TwigTemplate_69677fd1fcf8df2b44588b4de1c582ee1845c20cfb0d689ac591e588efacb385 extends Twig_Template
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
        $context['_seq'] = twig_ensure_traversable($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "categories", array()));
        foreach ($context['_seq'] as $context["_key"] => $context["category"]) {
            // line 2
            echo "\t<div class=\"row pricemonitor_category\">
\t\t<a href=\"";
            // line 3
            echo $this->env->getExtension('System')->appFilter(("/category/" . $this->getAttribute($context["category"], "value", array())));
            echo "\"><div class=\"col-xl-12\">";
            echo twig_escape_filter($this->env, $this->getAttribute($context["category"], "value", array()), "html", null, true);
            echo "</div></a>
\t</div>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['category'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 6
        echo "<div class=\"row pricemonitor_category\">
\t<a href=\"";
        // line 7
        echo $this->env->getExtension('System')->appFilter("/category/:uncategorized");
        echo "\"><div class=\"col-xl-12\">*uncategorized*</div></a>
</div>
<div class=\"row pricemonitor_category\">
\t<a href=\"";
        // line 10
        echo $this->env->getExtension('System')->appFilter("/category/:all");
        echo "\"><div class=\"col-xl-12\">*all*</div></a>
</div>
";
    }

    public function getTemplateName()
    {
        return "/home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/plugins/quamis/pricemonitor/components/productcategories/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  46 => 10,  40 => 7,  37 => 6,  26 => 3,  23 => 2,  19 => 1,);
    }
}
/* {% for category in __SELF__.categories %}*/
/* 	<div class="row pricemonitor_category">*/
/* 		<a href="{{ ('/category/' ~ category.value ) |app }}"><div class="col-xl-12">{{ category.value }}</div></a>*/
/* 	</div>*/
/* {% endfor %}*/
/* <div class="row pricemonitor_category">*/
/* 	<a href="{{ '/category/:uncategorized'|app }}"><div class="col-xl-12">*uncategorized*</div></a>*/
/* </div>*/
/* <div class="row pricemonitor_category">*/
/* 	<a href="{{ '/category/:all'|app }}"><div class="col-xl-12">*all*</div></a>*/
/* </div>*/
/* */
