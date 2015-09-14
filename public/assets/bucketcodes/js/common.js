
//Fixed Floating 2 decimal Places
function toFixedx(value, precision) {
    var power = Math.pow(10, precision || 0);
    return (Math.round(value * power) / power).toFixed(precision);
}

//Format Money
function format_money(num, precision) {
	precision = (precision === undefined) ? 2 : precision;
    var p = toFixedx(num, precision).split(".");

    //Lets check if it a negative number
    var isNegative = ( p[0] < 0 ) ? true : false;
    	if( isNegative ){ p[0] = -1 * p[0]; }

    var result = format_thousand(p[0]) + '.' + p[1];
    return ( isNegative ) ? '-' + result : result;
}

//Unformat Money
function unformat_money(currency){
	//if( currency === undefined ) return false;

	return Number(currency.replace(/[^0-9\.-]+/g,""));
}

//This would format thousand
function format_thousand(num){
	var newstr='', count=0, chars;
	num +=""; 
	/*var chars = num.split('').reverse();
    for (x in chars) {
        count++;
        if(count%3 == 1 && count != 1) {
            newstr = chars[x] + ',' + newstr;
        } else {
            newstr = chars[x] + newstr;
        }
    }*/
    newstr = num.replace(/\d{1,3}(?=(\d{3})+(?!\d))/g, "$&,");
    return newstr;
}

//Convert first letter to uppercase
String.prototype.capitalize = function(){
    return this.replace( /(^|\s)([a-z])/g , function(m,p1,p2){ return p1+p2.toUpperCase();
    } );
};

function _debug(msg){
	console.log(msg);
}