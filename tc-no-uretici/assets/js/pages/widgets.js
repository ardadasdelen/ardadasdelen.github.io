"use strict";

// Class definition
var KTWidgets = function () {
    // Private properties

    var getRandomNumber = function (min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    };
    
    var isNumber = function (n) {
        return !isNaN(parseFloat(n)) && isFinite(n)
    };
    var generateTckn = function () {
        var digits = [];
        var tckn = "";
        digits[0] = getRandomNumber(1,9);
        for(var i = 1; i < 9; i++) {
            digits[i] = getRandomNumber(0,9);
        }
        digits[9] = ((digits[0] + digits[2] + digits[4] + digits[6] + digits[8]) * 7 - 
                        (digits[1] + digits[3] + digits[5] + digits[7])) % 10;
        digits[10] = (digits[0] + digits[1] + digits[2] + digits[3] + digits[4] + digits[5] + 
                    digits[6] + digits[7] + digits[8] + digits[9]) % 10;
                    
        tckn = digits[0].toString() + digits[1].toString() + digits[2].toString() + digits[3].toString() + 
                digits[4].toString() + digits[5].toString() + digits[6].toString() + digits[7].toString() + 
                digits[8].toString() + digits[9].toString() + digits[10].toString();
        
        $("#txtTckn").val(tckn);
        
        controlTckn();
    };
    
    var generateTaxNumber = function (targetDiv) {
        var digits = [];
        var taxNumber = "";
        var sum = 0;
        
        for(i =0; i < 9; i++) {
            digits[i] = this.getRandomNumber(0,9);
        }
        
        for(i = 0; i < 9; i++) {
            var tmp = (digits[i] + 10 - ( i + 1 ) ) % 10;
            sum = (tmp == 9 ? sum + tmp : sum + ((tmp * (Math.pow(2, 10 - ( i + 1 ))) ) % 9));	
        }
        digits[9] = (10 - (sum % 10)) % 10
                    
        taxNumber = digits[0].toString() + digits[1].toString() + digits[2].toString() + digits[3].toString() + 
                digits[4].toString() + digits[5].toString() + digits[6].toString() + digits[7].toString() + 
                digits[8].toString() + digits[9].toString();
                
        return taxNumber;
    };

    var validateTckn = function () {
        var tckn = $("#txtTckn").val().trim();
        var digits = ("" + tckn).split("").map(Number);
        if (digits.length != 11 || !isNumber(tckn))
            return false;
       
        var digit10 = ((digits[0] + digits[2] + digits[4] + digits[6] + digits[8]) * 7 - (digits[1] + digits[3] + digits[5] + digits[7])) % 10;
        var digit11 = (digits[0] + digits[1] + digits[2] + digits[3] + digits[4] + digits[5] + digits[6] + digits[7] + digits[8] + digit10) % 10
        
        if(digits[9] == digit10 && digits[10] == digit11)
            return true;
        
        return false;
    };
    
    var validateTaxNumber = function () {
        var vergiNo = $("#vergiNoValidationInput").val();
        vergiNo = vergiNo.trim();
        var digits = ("" + vergiNo).split("").map(Number);
        var sum = 0;
        var tmp = 0;
        if (digits.length != 10)
            return false;
        for(i = 0; i < digits.length - 1; i++) {
            if(!SimlictJs.Utils.isNumber(digits[i]))
                return false;
            
            tmp = (digits[i] + 10 - ( i + 1 ) ) % 10;
            sum = (tmp == 9 ? sum + tmp : sum + ((tmp * (Math.pow(2, 10 - ( i + 1 ))) ) % 9));	
        }
        if (digits[digits.length -1] == (10 - (sum % 10)) % 10)
            return true;
            
        return false;
    };

    var copySpanValue = function (span) {
        var copyText = document.getElementById(span);
        copyText.select();
        document.execCommand("Copy");
        textArea.remove();
    }

    var controlTckn = function(){
        if(validateTckn()){
            $("#spanCheckTrue").show();
            $("#spanCheckFalse").hide();
            
        }
        else{
            $("#spanCheckTrue").hide();
            $("#spanCheckFalse").show();

        }
    }
    
    

    var _initTcknTxt = function()
    {
        var el = document.getElementById("txtTckn");
        KTUtil.addEvent(el, 'keyup', function(e) {
         
            controlTckn();
            
        });
    }

    var _initGenerateTcknBtn = function()
    {
        generateTckn();

        var el = document.getElementById("btnGenerateTckn");
        KTUtil.addEvent(el, 'click', function(e) {
            
        generateTckn();
        });
    }
    
    var _initControlTcknBtn = function()
    {
        var el = document.getElementById("btnControlTckn");
        KTUtil.addEvent(el, 'click', function(e) {
            controlTckn();
            
        });
    }

    var _initCopyTcknBtn = function()
    {
        var el = document.getElementById("btnCopyTckn");
        KTUtil.addEvent(el, 'click', function(e) {
            
            copySpanValue("txtTckn");
            
        });
    }

    // Public methods
    return {
        init: function () {
            
            _initTcknTxt();
            _initGenerateTcknBtn();
            _initControlTcknBtn();
            _initCopyTcknBtn();
        }
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTWidgets;
}

jQuery(document).ready(function () {
    KTWidgets.init();
});
