<?php

/* /home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/themes/responsiv-flat/pages/category.htm */
class __TwigTemplate_d66bdfab141d0e6e7a758e0afbf0cd0d816d2ab436c3f2ef31b3c201b2aecd89 extends Twig_Template
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
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('CMS')->componentFunction("breadcrumbs"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 2
        echo "
<div class=\"container\">
    <div>
        <div class=\"panel panel-default\">
            <div class=\"panel-heading\">";
        // line 6
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute((isset($context["this"]) ? $context["this"] : null), "param", array()), "category", array(), "array"), "html", null, true);
        echo "</div>
        </div>
        <div class=\"panel-body\">
            ";
        // line 9
        $context['__cms_component_params'] = [];
        echo $this->env->getExtension('CMS')->componentFunction("ProductList"        , $context['__cms_component_params']        );
        unset($context['__cms_component_params']);
        // line 10
        echo "        </div>
    </div>
</div>
<br/>";
    }

    public function getTemplateName()
    {
        return "/home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/themes/responsiv-flat/pages/category.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  39 => 10,  35 => 9,  29 => 6,  23 => 2,  19 => 1,);
    }
}
/* {% component 'breadcrumbs' %}*/
/* */
/* <div class="container">*/
/*     <div>*/
/*         <div class="panel panel-default">*/
/*             <div class="panel-heading">{{ this.param['category'] }}</div>*/
/*         </div>*/
/*         <div class="panel-body">*/
/*             {% component 'ProductList' %}*/
/*         </div>*/
/*     </div>*/
/* </div>*/
/* <br/>*/
