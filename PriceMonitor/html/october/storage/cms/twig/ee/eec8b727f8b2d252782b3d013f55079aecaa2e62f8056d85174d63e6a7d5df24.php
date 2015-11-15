<?php

/* /home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/plugins/quamis/pricemonitor/components/productattributes/default.htm */
class __TwigTemplate_f852af166d561e1199b7587efe46ee8a1588ffed02d7b0f9a2c6dbbfbaa0c6c3 extends Twig_Template
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
        echo "<form 
\tdata-request=\"";
        // line 2
        echo twig_escape_filter($this->env, (isset($context["__SELF__"]) ? $context["__SELF__"] : null), "html", null, true);
        echo "::onSave\"
>
\t\t<div class=\"form-group\">
\t\t\t<div class=\"input-group\">
\t\t\t\t<input name=\"category\" placeholder=\"category\" class=\"form-control\" type=\"text\" id=\"";
        // line 6
        echo twig_escape_filter($this->env, (isset($context["__SELF__"]) ? $context["__SELF__"] : null), "html", null, true);
        echo "_category\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "productAttributes", array(), "method"), "category", array()), "value", array()), "html", null, true);
        echo "\" />
\t\t\t\t<div class=\"input-group-addon\">Category</div>
\t\t\t</div>
\t\t</div>
\t\t<div class=\"form-group\">\t
\t\t\t<div class=\"input-group\">
\t\t\t\t<input name=\"quantity\" placeholder=\"123456.789\" class=\"form-control\" type=\"text\" id=\"";
        // line 12
        echo twig_escape_filter($this->env, (isset($context["__SELF__"]) ? $context["__SELF__"] : null), "html", null, true);
        echo "_quantity\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "productAttributes", array(), "method"), "quantity", array()), "value", array()), "html", null, true);
        echo "\" />
\t\t\t\t<div class=\"input-group-addon\">Quantity</div>
\t\t\t</div>
\t\t</div>
\t
\t\t<div class=\"form-group\">
\t\t\t<div class=\"input-group\">
\t\t\t\t<input name=\"quantity_UM\" placeholder=\"pcs, GB, cm\" class=\"form-control\" type=\"text\" id=\"";
        // line 19
        echo twig_escape_filter($this->env, (isset($context["__SELF__"]) ? $context["__SELF__"] : null), "html", null, true);
        echo "_quantity\" value=\"";
        echo twig_escape_filter($this->env, $this->getAttribute($this->getAttribute($this->getAttribute($this->getAttribute((isset($context["__SELF__"]) ? $context["__SELF__"] : null), "product", array()), "productAttributes", array(), "method"), "quantity_UM", array()), "value", array()), "html", null, true);
        echo "\" />
\t\t\t\t<div class=\"input-group-addon\">Quantity UM</div>
\t\t\t</div>
\t\t</div>
\t\t<button type=\"submit\" class=\"btn btn-primary btn-block\">Save</button>
</form>";
    }

    public function getTemplateName()
    {
        return "/home/exchangerate/PriceMonitor/PriceMonitor/html/short/october/plugins/quamis/pricemonitor/components/productattributes/default.htm";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  52 => 19,  40 => 12,  29 => 6,  22 => 2,  19 => 1,);
    }
}
/* <form */
/* 	data-request="{{ __SELF__ }}::onSave"*/
/* >*/
/* 		<div class="form-group">*/
/* 			<div class="input-group">*/
/* 				<input name="category" placeholder="category" class="form-control" type="text" id="{{ __SELF__ }}_category" value="{{ __SELF__.product.productAttributes().category.value }}" />*/
/* 				<div class="input-group-addon">Category</div>*/
/* 			</div>*/
/* 		</div>*/
/* 		<div class="form-group">	*/
/* 			<div class="input-group">*/
/* 				<input name="quantity" placeholder="123456.789" class="form-control" type="text" id="{{ __SELF__ }}_quantity" value="{{ __SELF__.product.productAttributes().quantity.value }}" />*/
/* 				<div class="input-group-addon">Quantity</div>*/
/* 			</div>*/
/* 		</div>*/
/* 	*/
/* 		<div class="form-group">*/
/* 			<div class="input-group">*/
/* 				<input name="quantity_UM" placeholder="pcs, GB, cm" class="form-control" type="text" id="{{ __SELF__ }}_quantity" value="{{ __SELF__.product.productAttributes().quantity_UM.value }}" />*/
/* 				<div class="input-group-addon">Quantity UM</div>*/
/* 			</div>*/
/* 		</div>*/
/* 		<button type="submit" class="btn btn-primary btn-block">Save</button>*/
/* </form>*/
