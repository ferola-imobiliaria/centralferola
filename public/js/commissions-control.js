let saleValue;function calcCommission(i,e){return parseFloat(i*e)/100}function insertComissions(i,e){$(i).unmask(),$(i).val(e).mask("#.##0,00",{reverse:!0})}$("#sale_value").on("change",function(){saleValue=parseFloat($(this).val().replace(/\./g,"").replace(",","")),isNaN(saleValue)?$("#commission_percentage, #commission_value, #realtor_percentage").attr("readonly",!0):$("#commission_percentage, #commission_value, #realtor_percentage").attr("readonly",!1)}),$("input#commission_percentage").on("focusout change",function(){insertComissions("#commission_value",calcCommission(saleValue,$(this).val())),$("input#commission_value").trigger("change")}),$("input#commission_value").on("focusout change",function(){let i=100*$(this).cleanVal()/saleValue;$("input#commission_percentage").val(i.toFixed(2)),insertComissions("input#catcher_commission",calcCommission($(this).cleanVal(),10)),insertComissions("input#supervisor_commission",calcCommission($(this).val().replace(".","").replace(",","."),2.5).toFixed(2)),$("#isExclusive").attr("disabled",!1),$("#realtor_percentage").trigger("change")}),$("input#realtor_percentage").on("focusout change",function(){insertComissions("input#realtor_commission",calcCommission($("input#commission_value").val().replace(".","").replace(",","."),$(this).val()).toFixed(2))}),$("input#realtor_percentage").on("focusout change",function(){let i=$("input#commission_value").cleanVal(),e=$("input#realtor_commission").cleanVal(),s=$("input#catcher_commission").cleanVal();if($("input#supervisor_commission").length)var n=$("input#supervisor_commission").cleanVal();else n=0;insertComissions("input#real_estate_commission",i-e-s-n)}),$('input:checkbox[id="isExclusive"]').on("change",function(){let i=calcCommission($("input#commission_value").cleanVal(),5),e=parseFloat($("input#real_estate_commission").cleanVal());insertComissions("input#exclusive_commission",i),$("#divExclusive").toggle("fadeIn",function(){$("#divExclusive").is(":hidden")?(insertComissions("input#real_estate_commission",e+i),$("input#exclusive").attr("required","true")):(insertComissions("input#real_estate_commission",e-i),$("input#exclusive").removeAttr("required"))})});