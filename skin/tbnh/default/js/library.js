var fBrw=(navigator.userAgent.indexOf('MSIE')!= -1 && navigator.userAgent.indexOf('Windows')!= -1);
var RefVal0 = new Array(); var RefVal1 = new Array(); var RefVal2 = new Array(); var RefVal3 = new Array(); 
var RefVal4 = new Array(); var RefVal5 = new Array(); var RefVal6 = new Array(); var RefVal7 = new Array(); 
var RefVal8 = new Array(); var RefVal9 = new Array(); var RefVal10 = new Array(); var RefVal11 = new Array(); 
var RefVal12 = new Array(); var RefVal13 = new Array(); var RefVal14 = new Array(); var RefVal15 = new Array(); 
var RefVal16 = new Array(); var RefVal17 = new Array(); var RefVal18 = new Array(); var RefVal19 = new Array();
var RefVal20 = new Array(); var RefVal21 = new Array(); var RefVal22 = new Array(); var RefVal23 = new Array();
var RefVal24 = new Array(); var RefVal25 = new Array(); var RefVal26 = new Array(); var RefVal27 = new Array();
var RefVal28 = new Array(); var RefVal29 = new Array(); var RefVal30 = new Array(); var RefVal31 = new Array();
var RefVal32 = new Array();

var cpms_Val5  = new Array(); var cpms_Val11  = new Array(); var cpms_Val12  = new Array(); var cpms_Val13  = new Array(); 
var cpms_Val31  = new Array(); var cpms_Val32  = new Array(); var cpms_Val33  = new Array(); var cpms_Val34  = new Array(); 
var cpms_Val35  = new Array(); var cpms_Val36  = new Array(); var cpms_Val37  = new Array();
var cpms_Val121  = new Array(); var cpms_Val122  = new Array(); var cpms_Val123  = new Array(); var cpms_Val124 = new Array();
var cpms_Val125 = new Array();

if (typeof(PageHost) == 'undefined') var PageHost = '';

function toUpper(sInput){
	sInput=sInput.toUpperCase()
	var sOutput='',sTemp;
	var i=0, j=0;
	for (var i=0;i<sInput.length;i++){
		if (sInput.charAt(i)+sInput.charAt(i+1)=='&#'){
			sTemp=sInput.substring(i+2,sInput.length);
			j=sTemp.indexOf(';');
			if (j>4){
				sOutput+=sInput.charAt(i);					
			}
			else{
				sTemp=sTemp.substring(0,j)
				switch(sTemp){
					case '225': {sOutput+='&#193;';break;}		//a'
					case '224': {sOutput+='&#192;';break;}		//a`
					case '7843': {sOutput+='&#7842;';break;}	//a?
					case '227': {sOutput+='&#195;';break;}		//a~
					case '7841': {sOutput+='&#7840;';break;}	//a.
					case '226': {sOutput+='&#194;';break;}		//a^
					case '7845': {sOutput+='&#7844;';break;}	//a^'
					case '7847': {sOutput+='&#7846;';break;}	//a^`
					case '7849': {sOutput+='&#7848;';break;}	//a^?
					case '7851': {sOutput+='&#7850;';break;}	//a^~
					case '7853': {sOutput+='&#7852;';break;}	//a^.
					case '259': {sOutput+='&#258;';break;}		//a(
					case '7855': {sOutput+='&#7854;';break;}	//a('
					case '7857': {sOutput+='&#7856;';break;}	//a(`
					case '7859': {sOutput+='&#7858;';break;}	//a(?
					case '7861': {sOutput+='&#7860;';break;}	//a(~
					case '7863': {sOutput+='&#7862;';break;}	//a(.
					case '273': {sOutput+='&#272;';break;}		//dd
					case '233': {sOutput+='&#201;';break;}		//e'
					case '232': {sOutput+='&#200;';break;}		//e`
					case '7867': {sOutput+='&#7866;';break;}	//e?
					case '7869': {sOutput+='&#7868;';break;}	//e~
					case '7865': {sOutput+='&#7864;';break;}	//e.
					case '234': {sOutput+='&#202;';break;}		//e^
					case '7871': {sOutput+='&#7870;';break;}	//e^'
					case '7873': {sOutput+='&#7872;';break;}	//e^`
					case '7875': {sOutput+='&#7874;';break;}	//e^?
					case '7877': {sOutput+='&#7876;';break;}	//e^~
					case '7879': {sOutput+='&#7878;';break;}	//e^.
					case '237': {sOutput+='&#205;';break;}		//i'
					case '236': {sOutput+='&#204;';break;}		//i`
					case '7881': {sOutput+='&#7880;';break;}	//i?
					case '297': {sOutput+='&#296;';break;}		//i~
					case '7883': {sOutput+='&#7882;';break;}	//i.
					case '243': {sOutput+='&#211;';break;}		//o'
					case '242': {sOutput+='&#210;';break;}		//i`
					case '7887': {sOutput+='&#7886;';break;}	//o?
					case '245': {sOutput+='&#213;';break;}		//o~
					case '7885': {sOutput+='&#7884;';break;}	//o.
					case '244': {sOutput+='&#212;';break;}		//o^
					case '7889': {sOutput+='&#7888;';break;}	//o^'
					case '7891': {sOutput+='&#7890;';break;}	//o^`
					case '7893': {sOutput+='&#7892;';break;}	//o^?
					case '7895': {sOutput+='&#7894;';break;}	//o^~
					case '7897': {sOutput+='&#7896;';break;}	//o^.
					case '417': {sOutput+='&#416;';break;}		//o*
					case '7899': {sOutput+='&#7898;';break;}	//o*'
					case '7901': {sOutput+='&#7900;';break;}	//o*`
					case '7903': {sOutput+='&#7902;';break;}	//o*?
					case '7905': {sOutput+='&#7904;';break;}	//o*~
					case '7907': {sOutput+='&#7906;';break;}	//o*.
					case '250': {sOutput+='&#218;';break;}		//u'
					case '249': {sOutput+='&#217;';break;}		//u`
					case '7911': {sOutput+='&#7910;';break;}	//u?
					case '361': {sOutput+='&#360;';break;}		//u~
					case '7909': {sOutput+='&#7908;';break;}	//u.
					case '432': {sOutput+='&#431;';break;}		//u*
					case '7913': {sOutput+='&#7912;';break;}	//u*'
					case '7915': {sOutput+='&#7914;';break;}	//u*`
					case '7917': {sOutput+='&#7916;';break;}	//u*?
					case '7919': {sOutput+='&#7918;';break;}	//u*~
					case '7921': {sOutput+='&#7920;';break;}	//u*.
					case '253': {sOutput+='&#221;';break;}		//y'
					case '7923': {sOutput+='&#7922;';break;}	//y`
					case '7927': {sOutput+='&#7926;';break;}	//y?
					case '7929': {sOutput+='&#7928;';break;}	//y~
					case '7925': {sOutput+='&#7924;';break;}	//y.
					default: {sOutput+='&#'+sTemp+';';break;}
				}
				i+=j+2;
			}
		}
		else{
			sOutput+=sInput.charAt(i);
		}
	}
	return sOutput;
}

function setCookie(Name, Path, Expires, Value)
{
	var cstr = Name.concat('=').concat(Value);	
	if(Path=='')
		Path = '/';
	cstr=cstr.concat(';path=').concat(Path);
	if(Expires=='')
		Expires=(new Date(2020,11,14)).toGMTString();
	document.cookie=cstr.concat(';expires=').concat(Expires);
}

function getCookie(Name, Default)
{
	var cookie = document.cookie;
	var ir = 0, ie = 0, sf = '', i = 0, j = 0;
	Name = Name.toLowerCase();
	if (typeof(Default) == 'undefined')
		Default = '';
	if (cookie.length == 0)
		return Default;
	if ((ir = Name.indexOf('.')) == -1)
	{
		if (cookie.substr(0, Name.length + 1).toLowerCase() == Name.concat('='))
		{
			if ((ie = cookie.indexOf(';')) != -1)
			{
				cookie = cookie.substr(0, ie);
			}
		}
		else
		{
			if ((ie = cookie.toLowerCase().indexOf('; '.concat(Name).concat('='))) == -1)
				return Default;
			cookie = cookie.substr(ie + 2);
			if ((ie = cookie.indexOf(';')) != -1)
			{
				cookie = cookie.substr(0, ie);
			}
		}
		sf = ';';
	}
	else
	{
		if ((i=cookie.toLowerCase().indexOf(Name.concat('='))) != -1)
		{
			if ((j = cookie.indexOf(';', i)) > i + Name.length + 1)
			{
				return ReplaceAll(unescape(cookie.substr(i + Name.length + 1, j - i - Name.length - 1)), '+', ' ');
			}
			else
			{
				j = cookie.length;
				return ReplaceAll(unescape(cookie.substr(i + Name.length + 1, j - i - Name.length - 1)), '+', ' ');
			}
		}

		var Root = Name.substr(0, ir);
		Name = Name.substr(ir + 1);
		if (cookie.substr(0, Root.length + 1).toLowerCase() == Root.concat('='))
		{
			if ((ie = cookie.indexOf(';')) != -1)
			{
				cookie = cookie.substr(0, ie);
			}
		}
		else
		{
			if ((ie = cookie.toLowerCase().indexOf('; '.concat(Root).concat('='))) == -1)
				return Default;

			cookie = cookie.substr(ie + 2);

			if ((ie = cookie.indexOf(';')) != -1)
			{
				cookie = cookie.substr(0, ie);
			}
		}
		cookie = cookie.substr(Root.length + 1);
		sf = '&';
	}

	if (cookie.substr(0, Name.length + 1).toLowerCase() == Name.concat('='))
	{
		ir = Name.length + 1;
	}
	else
	{
		if ((ir = cookie.toLowerCase().indexOf('&'.concat(Name).concat('='))) == -1)
			return Default;
		ir+=Name.length + 2;
	}
	if ((ie=cookie.indexOf(sf, ir)) == -1)
	{
		return ReplaceAll(unescape(cookie.substr(ir)), '+', ' ');
	}
	else
	{
		return ReplaceAll(unescape(cookie.substring(ir, ie)), '+', ' ');
	}
}
//================================
function checkCookie()
{
	if(!(getCookie1('fl')!=null && getCookie1('fl')!="")){
		setCookie1('fl',0,365);
	}

	fl=parseInt(getCookie1('fl')) + 1;
	if (fl!=null && fl!="")
	  {
	  //alert(fl);
	  setCookie1('fl',fl,365);
	  } 
	}
	function getCookie1(c_name)
	{
	if (document.cookie.length>0)
	  {
	  c_start=document.cookie.indexOf(c_name + "=");
	  if (c_start!=-1)
	    { 
	    c_start=c_start + c_name.length+1; 
	    c_end=document.cookie.indexOf(";",c_start);
	    if (c_end==-1) c_end=document.cookie.length;
	    return unescape(document.cookie.substring(c_start,c_end));
	    } 
	  }
	return "";
}

function setCookie1(c_name,value,expiredays)
{
	var exdate=new Date();
	exdate.setDate(exdate.getDate()+expiredays);
	document.cookie=c_name+ "=" +escape(value)+
	((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
}

//================================
function CharReplace(iStr)
{
	var	r1=/%26/g;
	var	r2=/%20/g;
	var	r3=/%22/g;
	iStr	=iStr.replace(r1, '&');
	iStr	=iStr.replace(r2, ' ');
	iStr	=iStr.replace(r3, '"');
	return iStr;
}

function SearchOnFocus(field)
{
	if(field.value=='Từ khóa tìm kiếm'){ field.value = ''; }
}

function SearchOnBlur(field)
{
	if(field.value==''){ field.value='Từ khóa tìm kiếm';}
}

function NameOnFocus(field)
{
	if(field.value=='Họ tên'){ field.value = ''; field.className = 'adword-textbox2'}
}

function NameOnBlur(field)
{
	if(field.value==''){ field.value='Họ tên'; field.className = 'adword-textbox'}
}

function EmailOnFocus(field)
{
	if(field.value=='Email'){ field.value = ''; field.className = 'adword-textbox2'}
}

function EmailOnBlur(field)
{
	if(field.value==''){ field.value='Email'; field.className = 'adword-textbox'}
}

function TitleOnFocus(field)
{
	if(field.value=='Tiêu đề'){ field.value = ''; field.className = 'adword-textbox2'}
}

function TitleOnBlur(field)
{
	if(field.value==''){ field.value='Tiêu đề'; field.className = 'adword-textbox'}
}

function ValidateCodeOnFocus(field)
{
	if(field.value=='Mã xác nhận'){ field.value = ''; field.className = 'adword-textbox2'}
}

function ValidateCodeOnBlur(field)
{
	if(field.value==''){ field.value='Mã xác nhận'; field.className = 'adword-textbox'}
}

function Trim(iStr)
{
	while (iStr.charCodeAt(0) <= 32)
	{
		iStr=iStr.substr(1);
	}

	while (iStr.charCodeAt(iStr.length - 1) <= 32)
	{
		iStr=iStr.substr(0, iStr.length - 1);
	}

	return iStr;
}

function Left(str, n)
{
	if (n <= 0)
	    return "";
	else if (n > String(str).length)
	    return str;
	else
	    return String(str).substring(0,n);
}

function Right(str, n)
{
    if (n <= 0)
       return "";
    else if (n > String(str).length)
       return str;
    else {
       var iLen = String(str).length;
       return String(str).substring(iLen, iLen - n);
    }
}

function numberFormat(num,decimalNum,bolLeadingZero,bolParens,bolCommas){ 
	if (isNaN(parseInt(num))) return "0";

	var tmpNum = num;
	var iSign = num < 0 ? -1 : 1; 

	tmpNum *= Math.pow(10,decimalNum);
	tmpNum = Math.round(Math.abs(tmpNum))
	tmpNum /= Math.pow(10,decimalNum);
	tmpNum *= iSign;

	var tmpNumStr = new String(tmpNum);

	if (!bolLeadingZero && num < 1 && num > -1 && num != 0)
		if (num > 0)
			tmpNumStr = tmpNumStr.substring(1,tmpNumStr.length);
		else
			tmpNumStr = "-" + tmpNumStr.substring(2,tmpNumStr.length);
				
	if (bolCommas && (num >= 1000 || num <= -1000)) {
		var iStart = tmpNumStr.indexOf(".");
		if (iStart < 0)
			iStart = tmpNumStr.length;

		iStart -= 3;
		while (iStart >= 1) {
			tmpNumStr = tmpNumStr.substring(0,iStart) + "," + tmpNumStr.substring(iStart,tmpNumStr.length)
			iStart -= 3;
		}                       
	}
	if (bolParens && num < 0)
				tmpNumStr = "(" + tmpNumStr.substring(1,tmpNumStr.length) + ")";
	return tmpNumStr;
}


function IPTV() {
	var sHTML = '';	
	sHTML = sHTML.concat('<Select name="cboIPTV" class="Image" style="width:225px;height:20px;font:11px arial;" id="tUtilityTelevisionChannel">');
	sHTML = sHTML.concat('	<Option value=1 selected>VTV1</Option>');
	sHTML = sHTML.concat('	<Option value=2>VTV2</Option>');
	sHTML = sHTML.concat('	<Option value=3>VTV3</Option>');	
	sHTML = sHTML.concat('	<Option value=4>VTV4</Option>');
	sHTML = sHTML.concat('	<Option value=5>VTV6</Option>');	
	sHTML = sHTML.concat('	<Option value=6>HTV1</Option>');
	sHTML = sHTML.concat('	<Option value=7>HTV2</Option>');
	sHTML = sHTML.concat('	<Option value=8>HTV3</Option>');
	sHTML = sHTML.concat('	<Option value=9>HTV4</Option>');		
	sHTML = sHTML.concat('	<Option value=10>HTV7</Option>');	
	sHTML = sHTML.concat('	<Option value=11>HTV9</Option>');	
	sHTML = sHTML.concat('	<Option value=12>Thu&#7847;n Vi&#7879;t</Option>');
	sHTML = sHTML.concat('	<Option value=13>HTVC - MUSIC</Option>');
	sHTML = sHTML.concat('	<Option value=14>HTVC - MOVIE</Option>');
	sHTML = sHTML.concat('	<Option value=15>VietnamNet</Option>');	
	sHTML = sHTML.concat('	<Option value=16>HanoiTV</Option>');
	sHTML = sHTML.concat('	<Option value=17>TVB8</Option>');
	sHTML = sHTML.concat('	<Option value=18>Disney</Option>');	
	sHTML = sHTML.concat('	<Option value=19>Du l&#7883;ch</Option>');
	sHTML = sHTML.concat('	<Option value=20>CNN</Option>');	
	sHTML = sHTML.concat('	<Option value=21>Bloomberg</Option>');
	sHTML = sHTML.concat('	<Option value=22>Star Movies</Option>');	
	sHTML = sHTML.concat('	<Option value=23>NHK World</Option>');
	sHTML = sHTML.concat('	<Option value=24>DW-TV</Option>');
	sHTML = sHTML.concat('	<Option value=25>Arirang</Option>');
	sHTML = sHTML.concat('	<Option value=26>News Asia</Option>');
	sHTML = sHTML.concat('	<Option value=27>Fashion TV</Option>');
	sHTML = sHTML.concat('	<Option value=28>TV5MONDE</Option>');	
	sHTML = sHTML.concat('	<Option value=29>Star World</Option>');	
	sHTML = sHTML.concat('	<Option value=30>FBNC</Option>');	
	sHTML = sHTML.concat('	<Option value=31>Phoenix Info</Option>');	
	sHTML = sHTML.concat('	<Option value=32>Star Sport</Option>');	
	sHTML = sHTML.concat('	<Option value=33>ESPN</Option>');	
	sHTML = sHTML.concat('	<Option value=34>BTV3</Option>');		
	sHTML = sHTML.concat('	<Option value=35>BTV5</Option>');		
	sHTML = sHTML.concat('	<Option value=36>Animax</Option>');	
	sHTML = sHTML.concat('	<Option value=37>Channel [V]</Option>');
	sHTML = sHTML.concat('	<Option value=38>V&#297;nh Long</Option>');
	sHTML = sHTML.concat('	<Option value=39>HTVC - Ph&#7909; N&#7919;</Option>');
	sHTML = sHTML.concat('	<Option value=40>HTVC - Gia &#272;&#236;nh</Option>');
	sHTML = sHTML.concat('	<Option value=41>&#272;&#7891;ng Nai 1</Option>');
	sHTML = sHTML.concat('	<Option value=42>&#272;&#7891;ng Nai 2</Option>');	
	sHTML = sHTML.concat('	<Option value=43>BTV1</Option>');
	sHTML = sHTML.concat('	<Option value=44>BTV2</Option>');
	sHTML = sHTML.concat('	<Option value=45>BTV4</Option>');
	sHTML = sHTML.concat('	<Option value=46>NOW-TV</Option>');
	sHTML = sHTML.concat('	<Option value=47>Playhouse Disney</Option>');
	sHTML = sHTML.concat('	<Option value=48>O2TV</Option>');
	sHTML = sHTML.concat('	<Option value=49>BTV9</Option>');
	sHTML = sHTML.concat('	<Option value=50>CCTV5</Option>');
	sHTML = sHTML.concat('	<Option value=51>VTV9</Option>');
	sHTML = sHTML.concat('	<Option value=52>iTV</Option>');
	sHTML = sHTML.concat('	<Option value=53>Australia NWK</Option>');
	sHTML = sHTML.concat('	<Option value=54>C&#7847;n Th&#417;</Option>');
	sHTML = sHTML.concat('	<Option value=55>HBO</Option>');
	sHTML = sHTML.concat('	<Option value=56>Cinemax</Option>');
	sHTML = sHTML.concat('	<Option value=57>VCTV3</Option>');
	sHTML = sHTML.concat('	<Option value=58>VCTV7</Option>');
	sHTML = sHTML.concat('	<Option value=59>Boomerang</Option>');
	sHTML = sHTML.concat('	<Option value=60>DW-TV Asia+</Option>');
	sHTML = sHTML.concat('	<Option value=61>H&#7843;i Ph&#242;ng</Option>');
	sHTML = sHTML.concat('	<Option value=62>Cartoon Network</Option>');
	sHTML = sHTML.concat('	<Option value=63>VTC1</Option>');
	sHTML = sHTML.concat('	<Option value=64>VTC2</Option>');
	sHTML = sHTML.concat('	<Option value=65>VTC3</Option>');
	sHTML = sHTML.concat('	<Option value=66>VTC7</Option>');
	sHTML = sHTML.concat('	<Option value=67>VTC9</Option>');
	sHTML = sHTML.concat('	<Option value=68>Astro C&#7843;m x&#250;c</Option>');
	sHTML = sHTML.concat('	<Option value=69>Info TV</Option>');
	sHTML = sHTML.concat('	<Option value=70>VTC8</Option>');
	sHTML = sHTML.concat('	<Option value=71>VTC10</Option>');
	sHTML = sHTML.concat('	<Option value=72>Super Sport 1</Option>');
	sHTML = sHTML.concat('	<Option value=73>Super Sport 2</Option>');
	sHTML = sHTML.concat('	<Option value=74>Super Sport 3</Option>');
	sHTML = sHTML.concat('	<Option value=100>VBC</Option>');
	sHTML = sHTML.concat('</Select>');	
	document.write(sHTML);
}

function ShowNextFolderItem(LastDate)
{
	if (PAGE_FOLDER < 1000 )
	{
		location.href = SetParameter(location.href + 'Default.Asp', 'd', escape(LastDate));
	}
	else
	{
		location.href = SetParameter(location.href, 'd', escape(LastDate));
	}	
}

function SetParameter(pFile, pName, pVal)
{
	if ((cPost=pFile.indexOf('&'.concat(pName).concat('=')))==-1)
		cPost=pFile.indexOf('?'.concat(pName).concat('='));

	if (cPost >= 0)
	{
		if ((pPost=pFile.indexOf('&', cPost + 1))==-1)
		{
			pFile=pFile.substring(0, cPost + pName.length + 2).concat(pVal);
		}
		else
		{
			pFile=pFile.substring(0, cPost + pName.length + 2).concat(pVal).concat(pFile.substr(pPost));
		}
	}
	else
	{
		if (pFile.indexOf('?')==-1)
		{
			pFile=pFile.concat('?').concat(pName).concat('=').concat(pVal);
		}
		else
		{
			pFile=pFile.concat('&').concat(pName).concat('=').concat(pVal);
		}
	}

	return pFile;
}

function CheckThisVote(field)
{
	form = field.form;		
	if (field.checked)
	{
		form.fvotefor.value = field.value;
	}
	else
	{
		form.fvotefor.value = '';		
		return;
	}

	for (i=0; i < form.elements.length; i++)
	{
		if(form.elements[i].type=='checkbox')
			if(form.name == 'Frm_267525551'){
				if(field.value != '1' && field.value != '2'){
					if (form.elements[i] != field)
						if (form.elements[i].checked)
							form.elements[i].checked = false;
				}
				else {
					field.checked = false;					
				}
			}
			else{
				if (form.elements[i] != field)
					if (form.elements[i].checked)
						form.elements[i].checked = false;
			}			
	}	
}

function ReplaceAll(iStr, v1, v2)
{
	var i = 0, oStr = '', j = v1.length;

	while (i < iStr.length)
	{
		if (iStr.substr(i, j) == v1)
		{
			oStr+=v2;
			i+=j
		}
		else
		{
			oStr+=iStr.charAt(i);
			i++;
		}
	}

	return oStr;
}

function ShowExpand(sobj1, sobj2)
{
	/*sobj1.style.display = 'none';
	sobj2.style.display = '';*/
	gmobj(sobj1).style.display = 'none';
	gmobj(sobj2).style.display = '';		
}

function SubmitVote(sform, saction)
{
	if (saction==0)
	{
		if (sform.fvotefor.value=='')
		{
			alert('Hay chon mot trong cac muc truoc khi bieu quyet.');
			return false;
		}
	}

	var form = sform;
	var j = 0
	for (i=0; i < form.elements.length - 2; i++)
		{
			if(form.elements[i].type=='checkbox'){
				j = j + 1
			}
		}
	var sheight = (j * 40) + 50;
	if (sheight < 250){
		sheight = 250;
	}
	open('', sform.name, 'scrollbars=yes,resizeable=no,locationbar=no,width=500,height='+sheight+',left='.concat((screen.width - 500)/2).concat(',top=').concat((screen.height - 250)/2));
	sform.faction.value = saction;
	sform.action = 'http://vnexpress.net/Service/Vote/Default.Asp' ;
	sform.submit();
}

function AddVote(SubjectID, PageID, VoteID, Align, VoteTitle, Color, BgColor, Width, NumItem, ItemArray, Description, Column)
{	
	document.writeln('	<table width="', Width, '" cellspacing="0" cellpadding="0" ', (PAGE_FOLDER==1) ? 'height="100%"' : '', ' border="0" ', (Align=='') ? '' : ' align='.concat(Align), '>');
	document.writeln('<form method="POST" target="Frm_', VoteID, '" name="Frm_', VoteID, '">');
	document.writeln('		<tr style="vertical-align:top">');
	document.writeln('			<td colspan="2" style="height:3px;background:#ffffff url(/images/vote/bg-top.gif) repeat-x top;"><img src="/images/vote/left-top.gif" /></td>');	
	document.writeln('			<td class="txtr" style="height:3px;background:#ffffff url(/images/vote/bg-top.gif) repeat-x top;"><img src="/images/vote/right-top.gif" /></td>');
	document.writeln('		</tr>');
	document.writeln('		<tr style="vertical-align:top">');
	document.writeln('			<td style="width:4px; height:21px;background:#ffffff url(/images/vote/bg-left.gif) repeat-y top;"></td>');
	document.writeln('			<td style="height:21px; vertical-align: top;padding-left: 8px; padding-top: 1px;padding-bottom: 2px; background-color: #ffffff;">');
	document.writeln('				<label class="link-folder">Th&#259;m d&#242; &#253; ki&#7871;n</label>');
	document.writeln('			</td>');
	document.writeln('			<td style="width:4px; height:21px;background:#ffffff url(/images/vote/bg-right.gif) repeat-y top;"></td>');
	document.writeln('		</tr>');
	document.writeln('		<tr>');
	document.writeln('	<td width:4px; style="background:#ffffff url(/images/vote/bg-left-c.gif) repeat-y top;"></td>');
	document.writeln('	<td valign="top" style="background-color:#eeeedd;">');
	document.writeln('		<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" valign="top">');
	document.writeln('			<tr>');
	document.writeln('				<td width="100%" valign="top">');
	document.writeln('					<table width="100%" height="100%" cellspacing="0" cellpadding="0" border="0" valgin="top">');
	if (VoteTitle!='')
	{
		document.writeln('					<tr valign="top">');
		document.writeln('						<td style="padding:10px 0px 10px 8px; background-color: #eeeedd;">');
		document.writeln('							<label style="font:bold 12px arial; color:#4d4d4d;">',VoteTitle,'</label>');
		document.writeln('						</td>');
		document.writeln('					</tr>');

	}
	if (typeof(Description)=='undefined')
	{
		Description = '';
	}
	if (typeof(Column)=='undefined')
	{
		Column = 1;
	}
	document.writeln('						<tr valign="top" height="100%">');
	document.writeln('							<td valign="top" style=" height:100%; padding-left:7px;background-color:#eeeedd;">');
	document.writeln('							<input type="hidden" name="fsubjectid" value=', SubjectID, '>');
	document.writeln('							<input type="hidden" name="fpageid" value=', PageID, '>');
	document.writeln('							<input type="hidden" name="fvoteid" value=', VoteID, '>');
	document.writeln('							<input type="hidden" name="fvotetitle" value="', ReplaceAll(VoteTitle, '"', '&quot;'), '">');
	document.writeln('							<input type="hidden" name="fvotefor" value="">');
	document.writeln('							<input type="hidden" name="faction" value="0">');
	document.writeln('							<input type="hidden" name="fDescription" value="', ReplaceAll(Description, '"', '&quot;'), '">');
	document.writeln('							<input type="hidden" name="fnumitem" value=', NumItem, '>');
	document.writeln('							<table width="100%" height="100%" cellspacing=0 cellpadding=0 border=0>');
	var i, j, k;
	for (i=0; i < NumItem; )
	{
		document.writeln('<tr>');
		for (j=0; j < Column && i < NumItem; j++, i++)
		{
			document.writeln('<input type="hidden" name="fT_', i, '" value="', ReplaceAll(ItemArray[i][0], '"', '&quot;'), '">');
			document.writeln('<input type="hidden" name="fI_', i, '" value="', ItemArray[i][1], '">');
			document.writeln('<input type="hidden" name="fN_', i, '" value="', ItemArray[i][2], '">');
			document.writeln('<td valign=top width=20px align=right><input type="checkbox" name="fC_', i, '" value=', ItemArray[i][2], ' style="font:12px arial;color:#000000;" onClick="CheckThisVote(this)"></td>');
			if (i + 1 < NumItem || Column==1)
			{
				document.writeln('<td valign=top><label style="font:12px arial; color: #000000; margin-left:2px; margin-right:2px">', ItemArray[i][0], '</label></td>');
			}
			else
			{
				document.writeln('<td colspan=', (Column - j - 1)*2,'><p  style="font:12px arial; color: #000000; margin-left: 2; margin-right: 2; margin-top:0px; margin-bottom:0px;">', ItemArray[i][0], '</p></td>');
			}
		}		
		document.writeln('</tr>');
	}
	document.writeln('</table>');
	document.writeln('								</td>');
	document.writeln('							</tr>');
	document.writeln('							<tr valign="top" height="10px"><td valign="top" align="center" style="background-color:#eeeedd;text-align:right;">');	
	document.writeln('							</td></tr>');
	document.writeln('						</table>');
	document.writeln('					</td>');
	document.writeln('				</tr>');
	document.writeln('			</table>');
	document.writeln('		</td>');
	document.writeln('		<td style=" width:4px; background:#ffffff url(/images/vote/bg-right-c.gif) repeat-y top;"></td>');
	document.writeln('	</tr>');
	document.writeln('	<tr>');
	document.writeln('		<td style="width:4px; height:25px;background:#ffffff url(/images/vote/bg-left.gif) repeat-y top;"></td>');
	document.writeln('		<td style="height:25px; padding:5px 5px 0px;background-color: #ffffff;" nowrap>');
	document.writeln('			<input type="image" border="0" onclick="return SubmitVote(this.form, 0)" style="cursor: pointer;" src="/Images/Vote/submit.gif">&nbsp;&nbsp;<input type="image" border="0" onclick="return SubmitVote(this.form, 1)" style="cursor: pointer;" src="/Images/Vote/view.gif">');
	document.writeln('		</td>');
	document.writeln('		<td style="height:25px; background: url(/images/vote/bg-right.gif);background-position:top;background-repeat:repeat-y; width:4; height:25;"></td>');
	document.writeln('	</tr>');
	document.writeln('	<tr>');
	document.writeln('		<td style="width:4px; height:5px; background:#ffffff url(/images/vote/left-bottom.gif) no-repeat bottom;"></td>');
	document.writeln('		<td style="height:5px; background:#ffffff url(/images/vote/bg-bottom.gif) repeat-x bottom;font-size:1px">&nbsp;</td>');
	document.writeln('		<td style="width:4px; height:5px; background:#ffffff url(/images/vote/right-bottom.gif) no-repeat bottom;"></td>');
	document.writeln('	</tr>');
	document.writeln('</form>');	
	document.writeln('</table>')
	
}

function ShowTopicJS(vFolderID, vItemCount, vType1, vType2, vCustomTitle, vPageCheck, vObjectID, vShowHeader, vSubjectID){
	var sId, sTitle, sType, sPath, iCount=0, iMaxItem=10;
	var arItem = new Array();
	var sLink = '/XML/'.concat(parseInt(vFolderID/100)).concat('/').concat(vFolderID).concat('.xml');
	var sHTML;
	
	AjaxRequest.get(
		{
	    'url':sLink
	    ,'onSuccess':function(req){
	    	if (req.responseXML.getElementsByTagName('Topic').length>0){
	    		with(req.responseXML.getElementsByTagName('Topic').item(0)){
					sId   = getNodeValue(getElementsByTagName('ID'));
					sTitle= getNodeValue(getElementsByTagName('Title'));
					sDate = getNodeValue(getElementsByTagName('ShowDate'));
					sType = toUpper(getNodeValue(getElementsByTagName('Type')));
					sPath = getNodeValue(getElementsByTagName('Path'));
	    		}
	    	}
	    	var iCount=0;
	    	for (var i=0;i<req.responseXML.getElementsByTagName('Subject').length;i++){
	    		with(req.responseXML.getElementsByTagName('Subject').item(i)){
	    			if (iCount<iMaxItem && iCount<vItemCount){
		    			var sTemp  = getNodeValue(getElementsByTagName('ID'));
						var sCheck = getNodeValue(getElementsByTagName('CheckShow'));
		    			if (sTemp!='' && displayid(sTemp) && sTemp!=vSubjectID && (vPageCheck==sCheck || sCheck==0)){
			    			arItem[iCount] = new Array(10);
							arItem[iCount][0] = getNodeValue(getElementsByTagName('Type'));
							arItem[iCount][1] = getNodeValue(getElementsByTagName('Title'));
							arItem[iCount][2] = getNodeValue(getElementsByTagName('Path'));							
							arItem[iCount][3] = getNodeValue(getElementsByTagName('Date'));
							iCount++;
						}
					}
	    		}
	    	}
			
			gmobj(vObjectID).innerHTML = GetTopicHTML(sId,sTitle,sDate,sPath,sType,sPath,arItem,vType1,vType2,vCustomTitle,vShowHeader);
	    }
	    ,'onError':function(req){gmobj(vObjectID).innerHTML='';}
		}
	)
}

function GetTopicHTML(sId,sTitle,sDate,sPath,sType,sPath,arItem,vType1,vType2,vCustomTitle,vShowHeader){
	var sHTML = '';
	var iCount=0, i=0;
	var sTdBullet='', sTableTopicTitle='';
	var sTopicTitle='Theo d&#242;ng s&#7921; ki&#7879;n';
	
	if(PAGE_FOLDER==127){
		sTopicTitle='C&#249;ng ch&#7911; &#273;&#7873;';
	}
	
	switch(vType2)
	{
	case 0: // ' 0 Default Title	
		sTableTopicTitle += '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
		sTableTopicTitle += '<tr><td class="OtherTitle" height="40" valign="middle">'+sTopicTitle+':</td></tr>';
		sTableTopicTitle += '</table>';
		sTdBullet='';
		break;
	case 1: // ' 1 User Defined Title
		sTableTopicTitle += '<table border="0" cellpadding="0" cellspacing="0" width="100%">';
		sTableTopicTitle += '<tr><td class="OtherTitle" height="40" valign="middle">'+vCustomTitle+'</td></tr>';
		sTableTopicTitle += '</table>';
		sTdBullet='';
		break;
	case 2: // ' 2 No Title
		sTrTopicTitle='';
		sTdBullet='';
		break;
	case 3: // ' 3 List Item Only
		sTrTopicTitle='';
		sTdBullet='<td width="7" valign="top" class="Normal">&#9642;</td>'
		break;
	}
	
	if (vShowHeader==0) sTableTopicTitle='';

	switch(vType1)		
	{
	case 1: // ' Topic
		sHTML += sTableTopicTitle;
		sHTML += '<table border="0" cellpadding="2" cellspacing="0" width="96%">';
		sHTML += '<tr><td><a href="/Topic/?ID='+sId+'" class="TopicTitle">'+sTitle+'</a><span class="ShowDate">&nbsp;('+sDate+')</span></td></tr>';
		sHTML += '</table>';
		break;
	case 2: // ' Subject
		sHTML += sTableTopicTitle;
		sHTML += '<table border="0" cellpadding="2" cellspacing="0" width="96%">';
		while (i<arItem.length)
		{
			sHTML += '<tr>'+sTdBullet+'<td><a class="Other" href="'+arItem[i][2]+'">'+arItem[i][1]+'</a><span class="ShowDate">&nbsp;('+arItem[i][3]+')</span></td></tr>';
			i++;
		}
		//sHTML += '<tr><td colspan="2" align="right"><a href="/Topic/?ID='+sId+'" class="Other">Xem ti&#7871;p</a></td></tr>';
		sHTML += '</table>';
		break;
	case 3: // ' Topic + Subject
		sHTML += sTableTopicTitle;
		sHTML += '<table border="0" cellpadding="2" cellspacing="0" width="96%">';
		sHTML += '<tr><td><a href="/Topic/?ID='+sId+'" class="TopicTitle">'+sTitle+'</a><span class="ShowDate">&nbsp;('+sDate+')</span></td></tr>';
		while (i<arItem.length)
		{
			sHTML += '<tr>'+sTdBullet+'<td><a class="Other" href="'+arItem[i][2]+'">'+arItem[i][1]+'</a><span class="ShowDate">&nbsp;('+arItem[i][3]+')</span></td></tr>';
			i++;
		}
		sHTML += '</table>';
		break;
	case 4: // ' Subject (before)
		sHTML += sTableTopicTitle;
		sHTML += '<table border="0" cellpadding="2" cellspacing="0" width="96%">';
		while (i<arItem.length)
		{
			sHTML += '<tr>'+sTdBullet+'<td><a class="Other" href="'+arItem[i][2]+'">'+arItem[i][1]+'</a><span class="ShowDate">&nbsp;('+arItem[i][3]+')</span></td></tr>';
			i++;
		}
		sHTML += '<tr><td align="right"><a class="Other" href="/Topic/?ID='+sId+'">Xem ti&#7871;p</a></td></tr>';
		sHTML += '</table>';
		break;
	case 5: // ' Topic + Subject (before)
		sHTML += sTableTopicTitle;
		sHTML += '<table border="0" cellpadding="2" cellspacing="0" width="96%">';
		sHTML += '<tr><td><a href="/Topic/?ID='+sId+'" class="TopicTitle">'+sTitle+'</a><span class="ShowDate">&nbsp;('+sDate+')</span></td></tr>';
		while (i<arItem.length)
		{
			sHTML += '<tr>'+sTdBullet+'<td><a class="Other" href="'+arItem[i][2]+'">'+arItem[i][1]+'</a><span class="ShowDate">&nbsp;('+arItem[i][3]+')</span></td></tr>';
			i++;
		}
		sHTML += '<tr><td align="right"><a class="Other" href="/Topic/?ID='+sId+'">Xem ti&#7871;p</a></td></tr>';
		sHTML += '</table>';
		break;
	}
	//if (sId==4953)	alert(sHTML);
	return sHTML;
}

function openImage(vLink, vHeight, vWidth)
{	
	var sLink = (typeof(vLink.href) == 'undefined') ? vLink : vLink.href;

	if (sLink == '')
	{
		return false;
	}

	winDef = 'status=no,resizable=no,scrollbars=no,toolbar=no,location=no,fullscreen=no,titlebar=yes,height='.concat(vHeight).concat(',').concat('width=').concat(vWidth).concat(',');
	winDef = winDef.concat('top=').concat((screen.height - vHeight)/2).concat(',');
	winDef = winDef.concat('left=').concat((screen.width - vWidth)/2);
	newwin = open('', '_blank', winDef);

	newwin.document.writeln('<body topmargin="0" leftmargin="0" marginheight="0" marginwidth="0">');
	newwin.document.writeln('<a href="" onClick="window.close(); return false;"><img src="', sLink, '" alt="', (fBrw) ? '&#272;&#243;ng l&#7841;i' : 'Dong lai', '" border=0></a>');
	newwin.document.writeln('</body>');

	if (typeof(vLink.href) != 'undefined')
	{
		return false;
	}
}

function PageSet(vPage)
{
	location.replace(SetParameter(location.href, 'p', vPage));
}

function ReverseFolderByDate()
{
	Ryear = document.Reverse.fYear.options[document.Reverse.fYear.selectedIndex].value;
	Rmonth = document.Reverse.fMonth.options[document.Reverse.fMonth.selectedIndex].value;
	Rday = document.Reverse.fDay.options[document.Reverse.fDay.selectedIndex].value;

	for (; Rday > 0; Rday--)
	{
		Rdate = new Date(Ryear, Rmonth - 1, Rday);
		if (Rdate.getDate() == Rday)
		{
			break;
		}
	}

	LastDate = Ryear.concat('/').concat(Rmonth).concat('/').concat(Rday).concat(' 23:59:59');
	location.href = SetParameter(location.href, 'd', escape(LastDate));	
}

function SetSelectValue(Field, iStr)
{
	if (iStr=='')
	{
		iStr=' ';
	}
	
	for (i=0; i < Field.options.length; i++)
	{
		if (Field.options[i].value==iStr)
		{
			Field.selectedIndex=i;
			return;
		}
	}
}

function ShowAdWordByCate(Field)
{
	location.replace(SetParameter('/User/Rao-vat/Source/List.Asp', 'c', Field.options[Field.selectedIndex].value));
	//location.href = SetParameter(location.href, 'c', Field.options[Field.selectedIndex].value);	
}

function ChangeProvince(i){
	gmobj('txtProvince').value = i;
	ChangeAdWordLink(gmobj('fCate').value,i);
}
function ChangeCate(){
	ChangeAdWordLink(gmobj('fCate').value,gmobj('txtProvince').value);
}
function ChangeAdWordLink(c,p)
{
	location.href = location.href.substring(0, location.href.indexOf('?')) + '?c=' + c + '&p=' + p;			
}

function EmailSubject(PageID)
{
	openMeExt('http://vnexpress.net/Service/EmailSubject/?u='.concat(escape(location.href)), 0, 0, 0, 0, 0, 0, 1, 1, 515, 480, 0, 0, '', 0);
	return false;
}

function ShowPopupUnder()
{
	if (RefVal15.length==0) return;	
	var alPopUnderBanner = new adlistshow(RefVal15,'PopUnderBanner',0,6,0,0,0);
}

function PrintSubject()
{	
	w=open(location.href.concat('?q=1'), '_blank', '');
	return false;	
}

function openAdWord(id, c)
{
	var url = 'http://vnexpress.net/Service/Raovat/Counter/?id=' + id + '&c=' + c + '&r=' + Math.random();		
	location.href = url;
	return false;
}

function openHelp(){
	winDef = 'scrollbars=no,status=no,toolbar=no,location=no,menubar=no,resizable=no,height=500,width=500,top='.concat((screen.height - 500)/2).concat(',left=').concat((screen.width - 500)/2);
	window.open('/User/Rao-vat/Source/Help.htm', 'Huongdan', winDef);
}

function CheckEmailAddress(Email)
{
	Email = Trim(Email);

	while (Email != '')
	{
		c = Email.charAt(0);	
		if (c==' ' || c=='<' || c==39 || c==':' || c=='.')
		{
			Email = Email.substr(1);
		}
		else
		{
			break;
		}
	}

	i = Email.indexOf('>');
	if (i==-1)
	{
		while (Email != '')
		{
			c = Email.charAt(Email.length - 1);
			if (c==' ' || c==39 || c=='.')
			{
				Email = Email.substr(0, Email.length - 1);
			}
			else
			{
				break;
			}
		}
	}
	else
	{
		Email = Email.substr(0, i);
	}

	if (Email.length > 96)
		return '';

	i = Email.lastIndexOf('@');
	j = Email.lastIndexOf('.');
	if (i < j)
		i = j;

	switch (Email.length - i - 1)
	{
	case 2:
		break;
	case 3:
		switch (Email.substr(i))
		{
		case '.com':
		case '.net':
		case '.org':
		case '.edu':
		case '.mil':
		case '.gov':
		case '.biz':
		case '.pro':
		case '.int':
			break;
		default:
			return '';
		}
		break;
	default:
		switch (Email.substr(i))
		{
		case '.name':
		case '.info':
			break;
		default:
			return '';
		}
		break;
	}

	Email = Email.toLowerCase();

	if (Email == '')
		return '';

	if (Email.indexOf(' ') != -1)
		return '';

	if (Email.indexOf('..') != -1)
		return '';

	if (Email.indexOf('.@') != -1)
		return '';

	if (Email.indexOf('@.') != -1)
		return '';

	if (Email.indexOf(':') != -1)
		return '';

	for (i=0; i < Email.length; i++)
	{
		c = Email.charAt(i);

		if (c >= '0' && c <= '9')
			continue;
		
		if (c >= 'a' && c <= 'z')
			continue;
		
		if ('`~!#$%^&*-_+=?/\\|@.'.indexOf(c) != -1)
			continue;

		return '';
	}

	if ((i=Email.indexOf('@'))==-1)
		return '';

	if (Email.substr(i + 1).indexOf('@')!=-1)
		return '';

	if (Email.charAt(0)=='.' || Email.charAt(Email.length - 1)=='.')
		return '';

	return Email;
}

function ChangeByEmail()
{
	if ((ChkEmail = CheckEmailAddress(document.frmEmail.txtEmail.value)) == '')
	{
		alert('Hay nhap dia chi [Email]!');
		document.frmEmail.txtEmail.focus();
		return;
	}

	document.frmEmail.txtEmail.value = ChkEmail;
	vWH = 190;
	vWW = 380;
	vWN = 'AwUpdate';
	winDef = 'status=no,resizable=no,scrollbars=yes,toolbar=no,location=no,fullscreen=no,titlebar=yes,height='.concat(vWH).concat(',').concat('width=').concat(vWW).concat(',');
	winDef = winDef.concat('top=').concat((screen.height - vWH)/2).concat(',');
	winDef = winDef.concat('left=').concat((screen.width - vWW)/2);
	newwin = open('http://vnexpress.net/User/Rao-vat/source/Select.Asp?email='.concat(document.frmEmail.txtEmail.value), vWN, winDef);
	newwin.focus();
}

function setAsHomePage(i)
{	
	if (document.all) {
		i.style.behavior='url(#default#homepage)';
		i.setHomePage('http://unnet.vn');
	}	
}

function ContactUs()
{
	open('/ContactUs/Contact.htm','Toasoan','height=360px,width=400px,status=no,toolba=no,location=no');
}

function GetPostVariable(vName, vDef)
{
	var	str=location.href;
	var	pos=str.indexOf('?'.concat(vName).concat('='));

	if (pos==-1)
	{
		pos=str.indexOf('&'.concat(vName).concat('='));
		if (pos==-1) return vDef;
	}
	
	str=str.substring(pos + vName.length + 2);
	pos=str.indexOf('&');

	if (pos==-1)
	{
		pos=str.length;
	}	

	if (pos > 0)
	{
		str=str.substring(0, pos);
	}

	return (typeof(vDef)=='number') ? parseInt(str) : CharReplace(str);
}

function UnicodeSet(iStr)
{
	for (i=0, oStr=''; i < iStr.length; i++)
	{
		switch ((j=iStr.charCodeAt(i)))
		{
		case 34:
			oStr=oStr.concat('&quot;');
			break;
		case 38:
			oStr=oStr.concat('&amp;');
			break;
		case 39:
			oStr = oStr.concat('&#39;');
			break;
		case 60:
			oStr = oStr.concat('&lt;');
			break;
		case 62:
			oStr = oStr.concat('&gt;');
			break;
		default:
			if (j < 32 || j > 127 || j==34 || j==39)
			{
				oStr=oStr.concat('&#').concat(j).concat(';');
			}
			else
			{
				oStr=oStr.concat(iStr.charAt(i)); 
			}
			break;
		}
	}
	
	return oStr;
}

function UnicodeGet(iStr)
{
	for (i=0, oStr=''; i < iStr.length; )
	{
		if (iStr.charCodeAt(i)==38)
		{
			if (iStr.charCodeAt(i + 1)==35)
			{
				p=iStr.indexOf(';', i  + 2);
				if (p!=-1)
				{
					if (p - i <= 7)
					{
						if (isFinite(iStr.substr(i + 2, p - i - 2)))
						{
							oStr = oStr.concat(String.fromCharCode(iStr.substr(i + 2, p - i - 2)));
							i = p + 1;
							continue;
						}
					}
				}
			}
			else
			{
				p=iStr.indexOf(';', i  + 1);
				if (p!=-1)
				{
					switch (iStr.substr(i + 1, p - i - 1))
					{
					case 'amp':
						oStr = oStr.concat('&');
						i = p + 1;
						break;
					case 'quot':
						oStr = oStr.concat('"');
						i = p + 1;
						break;
					case 'lt':
						oStr = oStr.concat('<');
						i = p + 1;
						break;
					case 'gt':
						oStr = oStr.concat('>');
						i = p + 1;
						break;
					}
				}
			}
		}
	
	
		oStr=oStr.concat(iStr.charAt(i));
		i++;
	}
	
	return oStr;
}

function SearchMe(s, a)
{	
	while (s.length > 0 && s.charAt(0) <= ' ')
	{
		s = s.substr(1);
	}

	while ((i=s.length) > 0 && s.charAt(i - 1) <= ' ')
	{
		s = s.substr(0, i - 1);
	}

	if (s=='')
	{
		document.Search.txtSearch.value = s;
		return false;
	}
	
	f = GetPostVariable('r', PAGE_FOLDER);
	s = escape(UnicodeSet(s));
	r = '';
	// if(PAGE_FOLDER==9998){
		// r = 'http://vnexpress.net';
	// }
	// if(PAGE_SITE == 0){
		// r = '/GL/Search/?p=1&r='.concat(f).concat('&a=').concat(a).concat('&s=').concat(s);
	// }
	// else if(PAGE_SITE == 1) {
		// r = '/HN/Search/?p=1&r='.concat(f).concat('&a=').concat(a).concat('&s=').concat(s);
	// }
	// else if(PAGE_SITE == 2) {
		// r = '/SG/Search/?p=1&r='.concat(f).concat('&a=').concat(a).concat('&s=').concat(s);
	// }
	r='http://search.vnexpress.net/news?s='.concat(s);

	if (location.pathname.toLowerCase()=='/search/')
	{
		location.replace(r);
	}
	else
	{
		location.href=r;
	}
	return false;
}

function UrlDecode(utftext) {
    var string = "";
    var i = 0;
    var c = c1 = c2 = 0;

    while ( i < utftext.length ) {

        c = utftext.charCodeAt(i);

        if (c < 128) {
            string += String.fromCharCode(c);
            i++;
        }
        else if((c > 191) && (c < 224)) {
            c2 = utftext.charCodeAt(i+1);
            string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
            i += 2;
        }
        else {
            c2 = utftext.charCodeAt(i+1);
            c3 = utftext.charCodeAt(i+2);
            string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
            i += 3;
        }

    }

    return string;
}


function ShowSearch()
{	
	if ((s=GetPostVariable('s', ''))!='')
	{
		s = ReplaceAll(s,'+',' ');
		s = unescape(s);
	}
	
	s = UrlDecode(s);

	

	if (s!='')
	{
		document.Search.s.value = s;
	}

}

function CheckEvt(e){
	var flag=false;
	if(window.event){
		if(e.keyCode==13){
			flag=true;
		}
	}
	else if(e.which){
		if(e.which==13){
			flag=true;
		}
	}
	if(flag){
		CheckValue(document.Search.s);
	}
}

function CheckValue(o){
	if(Trim(o.value)=='Từ khóa tìm kiếm'||Trim(o.value)==''){
		o.value = '';
		o.focus();
		return false;
	}
	else{
		document.Search.submit();
		return true;
	}		
}

function openMeExt(vLink, vStatus, vResizeable, vScrollbars, vToolbar, vLocation, vFullscreen, vTitlebar, vCentered, vHeight, vWidth, vTop, vLeft, vID, vCounter)
{
	var sLink = (typeof(vLink.href) == 'undefined') ? vLink : vLink.href;

	winDef = '';
	winDef = winDef.concat('status=').concat((vStatus) ? 'yes' : 'no').concat(',');
	winDef = winDef.concat('resizable=').concat((vResizeable) ? 'yes' : 'no').concat(',');
	winDef = winDef.concat('scrollbars=').concat((vScrollbars) ? 'yes' : 'no').concat(',');
	winDef = winDef.concat('toolbar=').concat((vToolbar) ? 'yes' : 'no').concat(',');
	winDef = winDef.concat('location=').concat((vLocation) ? 'yes' : 'no').concat(',');
	winDef = winDef.concat('fullscreen=').concat((vFullscreen) ? 'yes' : 'no').concat(',');
	winDef = winDef.concat('titlebar=').concat((vTitlebar) ? 'yes' : 'no').concat(',');
	winDef = winDef.concat('height=').concat(vHeight-140).concat(',');
	winDef = winDef.concat('width=').concat(vWidth).concat(',');

	if (vCentered){
		winDef = winDef.concat('top=').concat((screen.height - vHeight)/2).concat(',');
		winDef = winDef.concat('left=').concat((screen.width - vWidth)/2);
	}
	else{
		winDef = winDef.concat('top=').concat(vTop).concat(',');
		winDef = winDef.concat('left=').concat(vLeft);
	}

	if (typeof(vCounter) == 'undefined'){
		vCounter = 0;
	}

	if (typeof(vID) == 'undefined')	{
		vID = 0;
	}
	
	if (vCounter){
		sLink = buildLink(vID,sLink);
	}

	open(sLink, '_blank', winDef);

	if (typeof(vLink.href) != 'undefined')	{
		return false;
	}
}

function TrimAndRDS(iStr)
{
	function IsHyperLink(iStr)
	{
		var i = 0, c = ' ';

		if (iStr.charAt(0) == '.')
			return false;

		for (i=0; i < iStr.length; i++)
		{
			c = iStr.charAt(i).toLowerCase();
			if (c >= '0' && c <= '9')

				continue;
		
			if (c >= 'a' && c <= 'z')
				continue;
		
			if ('@_-&.?#+-/:'.indexOf(c) != -1)
				continue;

			return false;
		}
	
		return true;
	}

	function GetLastBreak(iStr, s)
	{
		var f = new Array('(', ')', '<', '>', ' ', '\r', '\n', '\t', ',', ';', '!'), p = 0, i = 0, r = -1;
	
		for (i = 0; i < f.length; i++)
			if ((p = iStr.lastIndexOf(f[i], s)) != -1)
				if (r == -1 || p > r)
					r = p;
		return r;
	}

	function GetNextBreak(iStr, s)
	{
		var f = new Array('(', ')', '<', '>', ' ', '\r', '\n', '\t', ',', ';', '!'), p = 0, i = 0, r = -1;
	
		for (i = 0; i < f.length; i++)
			if ((p = iStr.indexOf(f[i], s)) != -1)
				if (r == -1 || p < r)
					r = p;
		return r;
	}

	function CheckDotAfter(iStr)
	{
		var p0 = 0, p1 = 0, p2 = 0, p3 = 0;

		while ((p1 = iStr.indexOf('.', p0)) != -1)
		{
			if (iStr.charAt(p1 - 1) == ' ')
			{
				iStr = iStr.substr(0, p1 - 1).concat(iStr.substr(p1));
				p0 = p1;
			}
			else
			{
				p0 = p1 + 1;
			}

			if (iStr.charAt(p0) != ' ')
			{
				if ((p3 = GetLastBreak(iStr, p0)) == -1)
				{
					p3 = p0;
				}
				else
				{
					p3 = p3 + 1;
				}
		
				if ((p2 = GetNextBreak(iStr, p3)) == -1)
				{
					if (IsHyperLink(iStr.substr(p3)))
					{
						iStr = iStr.substr(0, p3).concat(iStr.substr(p3).toLowerCase())
						break;
					}
					else
					{
						if (iStr.charAt(p0) < '0' || iStr.charAt(p0) > '9')
						{
							iStr = iStr.substr(0, p0).concat(' ').concat(iStr.substr(p0, 1).toUpperCase()).concat(iStr.substr(p0 + 1));
							p0++;
						}
					}
				}
				else
				{
					if (IsHyperLink(iStr.substring(p3, p2)))
					{
						iStr = iStr.substr(0, p3).concat(iStr.substring(p3, p2).toLowerCase()).concat(iStr.substr(p2));
						p0 = p2 + 1;
					}
					else
					{
						if (iStr.charAt(p0) < '0' || iStr.charAt(p0) > '9')
						{
							iStr = iStr.substr(0, p0).concat(' ').concat(iStr.substr(p0, 1).toUpperCase()).concat(iStr.substr(p0 + 1));
							p0++;
						}
					}
				}
			}
			else
			{
				iStr = iStr.substr(0, p0 + 1).concat(iStr.substr(p0 + 1, 1).toUpperCase()).concat(iStr.substr(p0 + 2));
			}
		}	

		return iStr;
	}

	function CheckCharAfter(iStr, iChar, iUp)
	{
		var p0 = 0, p1 = 0;

		while ((p1 = iStr.indexOf(iChar, p0)) != -1)
		{
			if (iStr.charAt(p1 - 1) == ' ')
			{
				iStr = iStr.substr(0, p1 - 1).concat(iStr.substr(p1));
				p0 = p1;
			}
			else
			{
				p0 = p1 + 1;
			}

			if (iStr.charAt(p0) != ' ')
			{
				if (iStr.charAt(p0) < '0' || iStr.charAt(p0) > '9')
				{
					if (iUp)
					{
						iStr = iStr.substr(0, p0).concat(' ').concat(iStr.substr(p0, 1).toUpperCase()).concat(iStr.substr(p0 + 1));
					}
					else
					{
						iStr = iStr.substr(0, p0).concat(' ').concat(iStr.substr(p0));
					}
					p0++;
				}
			}
			else
			{
				if (iUp)
				{
					iStr = iStr.substr(0, p0 + 1).concat(iStr.substr(p0 + 1, 1).toUpperCase()).concat(iStr.substr(p0 + 2));
				}
			}
		}

		return iStr;
	}

	function CheckScope(iStr, s1, s2)
	{
		var p0 = 0, p1 = 0;

		for (p0 = 0; (p1 = iStr.indexOf(s1, p0)) != -1; )
		{
			if (iStr.charAt(p1 + 1) == ' ')
				iStr = iStr.substr(0, p1 + 1).concat(iStr.substr(p1 + 2));

			if (p1 > 0)
				if (iStr.charAt(p1 - 1) != ' ')
				{
					iStr = iStr.substr(0, p1).concat(' ').concat(iStr.substr(p1));
					p1++;
				}
			
			p0 = p1 + 1;
		}

		for (p0 = 0; (p1 = iStr.indexOf(s2, p0)) != -1; )
		{
			var SkipChar = ':,.;!?'.concat(s2);

			if (p1 > 0)
				if (iStr.charAt(p1 - 1) == ' ')
				{
					iStr = iStr.substr(0, p1 - 1).concat(iStr.substr(p1));
					p1--;
				}

			if (iStr.charAt(p1 + 1) != ' ' && SkipChar.indexOf(iStr.charAt(p1 + 1)) == -1)
				iStr = iStr.substr(0, p1 + 1).concat(' ').concat(iStr.substr(p1 + 1));

			p0 = p1 + 1;
		}		

		return iStr;
	}
	
	iStr = ReplaceAll(iStr, '  ', ' ');
	iStr = ReplaceAll(iStr, ' \r\n', '\r\n');
	iStr = ReplaceAll(iStr, '\r\n ', '\r\n');

	iStr = CheckCharAfter(iStr, ',', false);
	iStr = CheckCharAfter(iStr, ':', false);
	iStr = CheckCharAfter(iStr, ';', false);
	iStr = CheckCharAfter(iStr, '?', true);
	iStr = CheckCharAfter(iStr, '!', true);

	iStr = CheckScope(iStr, '(', ')');
	iStr = CheckScope(iStr, '[', ']');

	iStr = ReplaceAll(iStr, 'http: //', 'http://');
	iStr = CheckDotAfter(iStr);

	iStr = ReplaceAll(iStr, ', \r\n', ',\r\n');
	iStr = ReplaceAll(iStr, ': \r\n', ':\r\n');
	iStr = ReplaceAll(iStr, '; \r\n', ';\r\n');
	iStr = ReplaceAll(iStr, '? \r\n', '!\r\n');
	iStr = ReplaceAll(iStr, '! \r\n', '!\r\n');
	iStr = ReplaceAll(iStr, '. \r\n', '.\r\n');


	if (iStr.charAt(0) == ' ')
		iStr = iStr.substr(1);

	if (iStr.charAt(iStr.length - 1) == ' ')
		iStr = iStr.substr(0, iStr.length - 1);

	return iStr.substr(0, 1).toUpperCase().concat(iStr.substr(1));
}

function gmobj(o){
	if(document.getElementById){ m=document.getElementById(o); }
	else if(document.all){ m=document.all[o]; }
	else if(document.layers){ m=document[o]; }
	return m;
}

function dFormat(strDate) {
	var rStr = '';
	if(strDate=='') {
		sDate = rStr;
	}
	else {
		var tDates = strDate.split(" ");
		var tDay = tDates[0].split("/");
		var tTime = tDates[1].split(":");
		var oDay = new Date();		
		oDay.setFullYear(tDay[2],tDay[0]-1,tDay[1]);		
		switch(oDay.getDay()) {
			case 0:
				rStr = 'Ch&#7911; nh&#7853;t'; break;
			case 1:
				rStr = 'Th&#7913; hai'; break;
			case 2:
				rStr = 'Th&#7913; ba'; break;
			case 3:
				rStr = 'Th&#7913; t&#432;'; break;
			case 4:
				rStr = 'Th&#7913; n&#259;m'; break;
			case 5:
				rStr = 'Th&#7913; s&#225;u'; break;
			case 6:
				rStr = 'Th&#7913; b&#7843;y'; break;
			default: 
				rStr = ''; break;
		}
		rStr = rStr.concat(', ').concat(tDay[1]).concat('/').concat(tDay[0]).concat('/').concat(tDay[2]).concat(' | ');
		if(tDates[2] == 'AM') {
			if(tTime[0] < 10) {
				rStr = rStr.concat('0').concat(tTime[0]).concat(':');
			}
			else {
				rStr = rStr.concat(tTime[0]).concat(':');
			}
		}
		else {
			if(tTime[0]!=12){
				tTime[0] = 12 + parseInt(tTime[0]);						
			}
			rStr = rStr.concat(tTime[0]).concat(':');
		}
		
		if(tTime[1] < 10) {
			rStr = rStr.concat('0').concat(tTime[1]);
		}
		else {
			rStr = rStr.concat(tTime[1]);
		}
		
		rStr = rStr.concat(' GMT+7&nbsp;');
		sDate = rStr;
	}
}

function dmy(strDate) {
	var temp = new Array();
	temp = strDate.split('/');
	/*if(temp[1] < 10) {
		temp[1] = '0' + temp[1];
	}
	if(temp[0] < 10) {
		temp[0] = '0' + temp[0];
	}*/
	//return temp[1].concat('/').concat(temp[0]).concat('/').concat(temp[2]);
	return temp[1].concat('/').concat(temp[0]);
}

function Hexa(input){
	return Right('00000000'.concat(input.toString(16)),8);	
}

function HexToDec(input){		
	var rt = 0;
	var cha = '';
	var temp;
	var len = input.length;
	for(var i=1;i<=len; i++) {
		cha = Left(input,1);
		switch (cha){
			case 'A': case 'a': temp = 10; break;
			case 'B': case 'b': temp = 11; break;
			case 'C': case 'c': temp = 12; break;
			case 'D': case 'd': temp = 13; break;
			case 'E': case 'e': temp = 14; break;
			case 'F': case 'f': temp = 15; break;
			default: temp = parseInt(cha); break;
		}		
		rt = rt + temp * Math.pow(16,len-i);
		input = Right(input,len-i);
	}		
	return rt;
}

function ShowStock(i){
	if(i == 0){
		gmobj('HO2').className = 'st-li-ho fl';
		gmobj('HA2').className = 'st-li-ha2 fl';
		gmobj('oHO2').className = 'st-act';
		gmobj('oHA2').className = 'st-deact';							
		gmobj('CONT').innerHTML = gmobj('HOSE').innerHTML;
	}
	else{				
		gmobj('HO2').className = 'st-li-ho2 fl';
		gmobj('HA2').className = 'st-li-ha fl';
		gmobj('oHO2').className = 'st-deact';
		gmobj('oHA2').className = 'st-act';	
		gmobj('CONT').innerHTML = gmobj('HASTC').innerHTML;
	}
}

function ShowTopStock(i){   
	if(i == 0){
		gmobj('top5-hose').className = 'st-act';
		gmobj('top5-hastc').className = 'st-deact';
		gmobj('TOP5CONT').innerHTML = gmobj('TOP5HOSE').innerHTML;
	}
	else{						
		gmobj('top5-hose').className = 'st-deact';
		gmobj('top5-hastc').className = 'st-act';
		gmobj('TOP5CONT').innerHTML = gmobj('TOP5HASTC').innerHTML;
	}
}

function ShowFlashObject(objName, objFileName, objWidth, objHeight) {
	var sHTML = '';
	sHTML = sHTML.concat('<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0" WIDTH="').concat(objWidth).concat('" HEIGHT="').concat(objHeight).concat('" ID="').concat(objName).concat('" >');	
	sHTML = sHTML.concat('	<PARAM NAME="movie" VALUE="').concat('/Images/AdWord/').concat(objFileName).concat('">');
	sHTML = sHTML.concat('	<PARAM NAME="AllowScriptAccess" VALUE="always">');
	sHTML = sHTML.concat('	<PARAM NAME="quality" VALUE="high">');
	sHTML = sHTML.concat('	<PARAM NAME="bgcolor" VALUE="#FFFFFF">');	
	sHTML = sHTML.concat('	<PARAM NAME="wmode" VALUE="transparent">');	
	sHTML = sHTML.concat('	<EMBED src="').concat('/Images/AdWord/').concat(objFileName).concat('" quality="high" bgcolor="#FFFFFF" WIDTH="').concat(objWidth).concat('" HEIGHT="').concat(objHeight).concat('" NAME="').concat(objName).concat('" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer" wmode="transparent" AllowScriptAccess="always" >');
	sHTML = sHTML.concat('</OBJECT>');
	return sHTML;		
}

/*-----------------Banner---------------------------*/
function ShowTopBanner()
{
	if (RefVal1.length>0)
	{
		document.writeln('<div>');		
		var alTopBanner = new adlistshow(RefVal1,'TopBanner',0,10,0,728,90,true,1,30000);		
		document.writeln('</div>');
	}
	else
	{		
		document.writeln('<div style="float:left;width:728;">');	
		document.writeln(ShowFlashObject('AdTopBanner', 'lhqc_vne_728x90.swf', 728, 90));
		document.writeln('</div>');	
		return;
	}
}

function ShowHalfBaner(vType)
{
	if (typeof(vType) == 'undefined') vType = 2;
	if (vType==2){
		if (RefVal2.length>0)
		{
			document.writeln('<div class="halfbanner fl">');
			var alHalfBanner2 = new adlistshow(RefVal2,'HalfBanner2',0,10,0,364,90,true,0,30000);
			document.writeln('</div>');
		}
		else
		{					
			document.writeln('<div class="halfbanner fl">');		
			document.writeln(ShowFlashObject('AdHalfBaner1', 'lhqc_vne_364x90.swf', 364, 90));
			document.writeln('</div>');	
			return;
		}
	}
	else if (vType==3){
		if (RefVal3.length>0)
		{
			document.writeln('<div class="halfbanner fr">');
			var alHalfBanner3 = new adlistshow(RefVal3,'HalfBanner3',0,10,0,364,90,true,1,30000);
			document.writeln('</div>');
		}
		else
		{					
			document.writeln('<div class="halfbanner fr">');		
			document.writeln(ShowFlashObject('AdHalfBaner2', 'lhqc_vne_364x90.swf', 364, 90));
			document.writeln('</div>');	
			return;
		}
	}
}

function ShowRightLogo(vType)
{
	if (typeof(vType) == 'undefined') vType = 1;
/*	
	if (vType==1){
		if (RefVal8.length>0)
		{
			document.writeln('<div class="fl">');
			var alRightLogo1 = new adlistshow(RefVal8,'RightLogo1',0,10,0,120,240,'undefined',3,30000);
			document.writeln('</div>');
		}
		else
		{			
			document.writeln('<div class="fl">');		
			document.writeln(ShowFlashObject('AdRightLogo1', 'lhqc_vne_120x240.swf', 120, 240));
			document.writeln('</div>');			
			return;
		}
	}
	else if (vType==2){
		if (RefVal9.length>0)
		{
			document.writeln('<div class="fl">');
			var alRightLogo2 = new adlistshow(RefVal9,'RightLogo2',0,10,0,120,240,'undefined',3,30000);
			document.writeln('</div>');
		}
		else
		{				
			document.writeln('<div class="fl">');		
			document.writeln(ShowFlashObject('AdRightLogo2', 'lhqc_vne_120x240.swf', 120, 240));
			document.writeln('</div>');
			return;
		}
	}
*/
	if (vType==1){
		if (cpms_Val124.length>0)
		{
			document.writeln('<div class="fl">');
			var alRightLogo1 = new cpmst_adlistshow(cpms_Val124,'RightLogo1',0,10,0,120,240,'undefined',3,30000);
			document.writeln('</div>');
		}
		else
		{			
			document.writeln('<div class="fl">');		
			document.writeln(ShowFlashObject('AdRightLogo1', 'lhqc_vne_120x240.swf', 120, 240));
			document.writeln('</div>');			
			return;
		}
	}
	else if (vType==2){
		if (cpms_Val125.length>0)
		{
			document.writeln('<div class="fl">');
			var alRightLogo2 = new cpmst_adlistshow(cpms_Val125,'RightLogo2',0,10,0,120,240,'undefined',3,30000);
			document.writeln('</div>');
		}
		else
		{				
			document.writeln('<div class="fl">');		
			document.writeln(ShowFlashObject('AdRightLogo2', 'lhqc_vne_120x240.swf', 120, 240));
			document.writeln('</div>');
			return;
		}
	}
}

function ShowLargeLogo(vType)
{
	if (typeof(vType) == 'undefined') vType = 1;
/*	
	if (vType==1){
		if (RefVal4.length>0)
		{
			document.writeln('<div class="box-item">');			
			var alLargeLogo1 = new adlistshow(RefVal4,'LargeLogo1',0,0,0,300,120,'undefined','undefined',30000);
			document.writeln('</div>');
			return;
		}
		else
		{			
			document.writeln('<div class="box-item">');			
			document.writeln(ShowFlashObject('AdLargeLogo1', 'lhqc_vne_300x120.swf', 300, 120));
			document.writeln('</div>');				
			return;
		}
	}
	else if(vType==2) {
		if (RefVal5.length>0)
		{
			document.writeln('<div class="box-item">');
			//var alLargeLogo2 = new adlistshow(RefVal5,'LargeLogo2',0,0,0,300,120);			
			var alLargeLogo2 = new adlistshow(RefVal5,'LargeLogo2',0,10,0,300,120,true,1,30000);
			document.writeln('</div>');
			return;
		}
		else
		{			
			document.writeln('<div class="box-item">');			
			document.writeln(ShowFlashObject('AdLargeLogo2', 'lhqc_vne_300x120.swf', 300, 120));
			document.writeln('</div>');	
			return;
		}
	}
	else if (vType==3) {
		if (RefVal20.length>0)
		{
			document.writeln('<div class="box-item">');	
			ShowBigAdvHeader();
			//var alLargeLogo3 = new adlistshow(RefVal20,'LargeLogo3',0,0,0,300,250,'undefined','undefined',30000);
			var alLargeLogo3 = new adlistshow(RefVal20,'LargeLogo3',0,10,0,300,250,'undefined',1,30000);
			document.writeln('</div>');
			return;
		}
		else
		{			
			document.writeln('<div class="box-item">');		
			ShowBigAdvHeader();
			document.writeln(ShowFlashObject('AdLargeLogo3', 'lhqc_vne_300x250.swf', 300, 250));
			document.writeln('</div>');	
			return;
		}
	}
	else if(vType==4) {
		if (RefVal10.length>0)
		{
			document.writeln('<div class="box-item">');	
			ShowBigAdvHeader();
			//var alLargeLogo4 = new adlistshow(RefVal10,'LargeLogo4',0,0,0,300,250,'undefined','undefined',30000);
			var alLargeLogo4 = new adlistshow(RefVal10,'LargeLogo4',0,10,0,300,250,'undefined',1,30000);
			document.writeln('</div>');
			return;
		}
		else
		{					
			document.writeln('<div class="box-item">');			
			ShowBigAdvHeader();
			document.writeln(ShowFlashObject('AdLargeLogo4', 'lhqc_vne_300x250.swf', 300, 250));
			document.writeln('</div>');	
			return;
		}
	}
	else if(vType==5) {
		if (RefVal11.length>0)
		{
			document.writeln('<div class="box-item">');	
			ShowBigAdvHeader();
			var alLargeLogo4 = new adlistshow(RefVal11,'LargeLogo5',0,0,0,300,250,'undefined','undefined',30000);
			document.writeln('</div>');
			return;
		}
		else
		{					
			document.writeln('<div class="box-item">');			
			ShowBigAdvHeader();
			document.writeln(ShowFlashObject('AdLargeLogo5', 'lhqc_vne_300x250.swf', 300, 250));
			document.writeln('</div>');	
			return;
		}
	}
	else if(vType==6) {
		if (RefVal22.length>0)
		{
			document.writeln('<div class="box-item">');
			var alLargeLogo2 = new adlistshow(RefVal22,'LargeLogo6',0,0,0,300,120,'undefined','undefined',30000);
			document.writeln('</div>');
			return;
		}
		else
		{			
			document.writeln('<div class="box-item">');			
			document.writeln(ShowFlashObject('AdLargeLogo6', 'lhqc_vne_300x120.swf', 300, 120));
			document.writeln('</div>');	
			return;
		}
	}
*/
	if (vType==1){
		if (cpms_Val121.length>0)
		{
			document.writeln('<div class="box-item">');			
			var alLargeLogo1 = new cpmst_adlistshow(cpms_Val121,'LargeLogo1',0,0,0,300,120,'undefined','undefined',30000);
			document.writeln('</div>');
			return;
		}
		else
		{			
			document.writeln('<div class="box-item">');			
			document.writeln(ShowFlashObject('AdLargeLogo1', 'lhqc_vne_300x120.swf', 300, 120));
			document.writeln('</div>');				
			return;
		}
	}
	else if(vType==2) {
		if (cpms_Val122.length>0)
		{
			document.writeln('<div class="box-item">');					
			var alLargeLogo2 = new cpmst_adlistshow(cpms_Val122,'LargeLogo2',0,10,0,300,120,true,1,30000);
			document.writeln('</div>');
			return;
		}
		else
		{			
			document.writeln('<div class="box-item">');			
			document.writeln(ShowFlashObject('AdLargeLogo2', 'lhqc_vne_300x120.swf', 300, 120));
			document.writeln('</div>');	
			return;
		}
	}
	else if (vType==3) {
		if (cpms_Val11.length>0)
		{
			document.writeln('<div class="box-item">');	
			ShowBigAdvHeader();			
			var alLargeLogo3 = new cpmst_adlistshow(cpms_Val11,'LargeLogo3',0,10,0,300,250,'undefined',1,30000);
			document.writeln('</div>');
			return;
		}
		else
		{			
			document.writeln('<div class="box-item">');		
			ShowBigAdvHeader();
			document.writeln(ShowFlashObject('AdLargeLogo3', 'lhqc_vne_300x250.swf', 300, 250));
			document.writeln('</div>');	
			return;
		}
	}
	else if(vType==4) {
		if (cpms_Val12.length>0)
		{
			document.writeln('<div class="box-item">');	
			ShowBigAdvHeader();			
			var alLargeLogo4 = new cpmst_adlistshow(cpms_Val12,'LargeLogo4',0,10,0,300,250,'undefined',1,30000);
			document.writeln('</div>');
			return;
		}
		else
		{					
			document.writeln('<div class="box-item">');			
			ShowBigAdvHeader();
			document.writeln(ShowFlashObject('AdLargeLogo4', 'lhqc_vne_300x250.swf', 300, 250));
			document.writeln('</div>');	
			return;
		}
	}
	else if(vType==5) {
		if (cpms_Val13.length>0)
		{
			document.writeln('<div class="box-item">');	
			ShowBigAdvHeader();
			var alLargeLogo4 = new cpmst_adlistshow(cpms_Val13,'LargeLogo5',0,0,0,300,250,'undefined','undefined',30000);
			document.writeln('</div>');
			return;
		}
		else
		{					
			document.writeln('<div class="box-item">');			
			ShowBigAdvHeader();
			document.writeln(ShowFlashObject('AdLargeLogo5', 'lhqc_vne_300x250.swf', 300, 250));
			document.writeln('</div>');	
			return;
		}
	}
	else if(vType==6) {
		if (cpms_Val123.length>0)
		{
			document.writeln('<div class="box-item">');
			var alLargeLogo2 = new cpmst_adlistshow(cpms_Val123,'LargeLogo6',0,0,0,300,120,'undefined','undefined',30000);
			document.writeln('</div>');
			return;
		}
		else
		{			
			document.writeln('<div class="box-item">');			
			document.writeln(ShowFlashObject('AdLargeLogo6', 'lhqc_vne_300x120.swf', 300, 120));
			document.writeln('</div>');	
			return;
		}
	}
}

function ShowBigLogo()
{
	document.writeln('<div class="fl">');
	//var alBigLogo1 = new adlistshow(RefVal6,'BigLogo1',0,1,0,180,600,'undefined','undefined',30000);	
	var alBigLogo1 = new cpmst_adlistshow(cpms_Val31,'BigLogo1',0,1,0,180,600,'undefined','undefined',30000);	
	document.writeln('</div>');	
}

function ShowBigLogo2()
{
	document.writeln('<div class="fl">');
	//var alBigLogo2 = new adlistshow(RefVal18,'BigLogo2',0,1,0,180,600);
	var alBigLogo2 = new cpmst_adlistshow (cpms_Val32,'BigLogo2',0,1,0,180,600);
	document.writeln('</div>');	
}

function ShowBasicLogo(vAd)
{
	if (typeof(vAd) == 'undefined') vAd = 0;	
	document.writeln('<div class="fl">');	
	//var alBasicLogo = new adlistshow(RefVal7,'BasicLogo',vAd,1,0,180,600,false,'undefined',30000);
	var alBasicLogo = new cpmst_adlistshow(cpms_Val33,'BasicLogo',vAd,1,0,180,600,false,'undefined',30000);
	document.writeln('</div>');
}

function ShowBasicLogo2(vAd)
{
	if (typeof(vAd) == 'undefined') vAd = 0;
	document.writeln('<div class="fl">');	
	var alBasicLogo = new adlistshow(RefVal10,'BasicLogo2',vAd,10,0,180,300,false,1,30000);
	document.writeln('</div>');
}

function ShowRightExpand(vAd)
{	
	document.writeln('<div style="margin-bottom:3px;" class="fl">');
	if (typeof(vAd) == 'undefined') vAd = 0;		
	//var alRightExpand = new adlistshow(RefVal17,'RightExpandLogo',0,16,0,180,300,true,1,30000);
	var alRightExpand = new cpmst_adlistshow(cpms_Val34,'RightExpandLogo',0,16,0,180,300,true,1,30000);
	document.writeln('</div>');	
}

function ShowRightExpand2(vAd)
{	
	document.writeln('<div style="margin-bottom:3px;" class="fl">');
	if (typeof(vAd) == 'undefined') vAd = 0;	
	//var alRightExpand = new adlistshow(RefVal27,'RightExpandLogo2',vAd,10,0,180,600,true,1,30000);
	var alRightExpand = new cpmst_adlistshow(cpms_Val35,'RightExpandLogo2',vAd,10,0,180,600,true,1,30000);
	document.writeln('</div>');	
}

function ShowSpecialBanner(vAd)
{
	if (typeof(vAd) == 'undefined') vAd = 0;	
	document.writeln('<div class="fl">');	
	//var alBasicLogo = new adlistshow(RefVal19,'SpecialLogo',vAd,1,0,180,900,true,'undefined',30000);
	var alBasicLogo = new cpmst_adlistshow(cpms_Val36,'SpecialLogo',vAd,1,0,180,900,true,'undefined',30000);
	document.writeln('</div>');
}



function ShowArticlebanner(vAd)
{	
	if(RefVal16.length>0){
		ShowArticlebanner1();
	}
	if(RefVal21.length>0){
		ShowArticlebanner2();
	}
}

function ShowArticlebanner1(vAd)
{
	if (typeof(vAd) == 'undefined') vAd = 0;
	document.writeln('<div class="txtc" style="margin-top: 5px;" width="100%">');
	var alBasicLogo1 = new adlistshow(RefVal16,'ArticleBanner1',vAd,1,0,468,60,true,2,30000);
	document.writeln('</div>');
}

function ShowArticlebanner2(vAd)
{	
	if (typeof(vAd) == 'undefined') vAd = 0;
	document.writeln('<div class="txtc" style="margin-top: 5px;" width="100%">');
	var alBasicLogo2 = new adlistshow(RefVal21,'ArticleBanner2',vAd,1,0,468,60,true,2,30000);
	document.writeln('</div>');
}


function ShowLogoRight(vAd) {	
/*	if (RefVal6.length+RefVal7.length+RefVal17.length+RefVal27.length+RefVal18.length+RefVal19.length+RefVal32.length==0){		
		document.writeln('<div class="fl">');		
		document.writeln(ShowFlashObject('AdLogoRight', 'lhqc_vne_180x150.swf', 180, 150));
		document.writeln('</div>');
		return;
	}
	if(RefVal32.length!=0) ShowDropBanner();
	if(RefVal6.length!=0) ShowBigLogo();
	if(RefVal17.length!=0) ShowRightExpand(vAd);
	if(RefVal27.length!=0) ShowRightExpand2(vAd);
	if(RefVal18.length!=0) ShowBigLogo2(vAd);
	if(RefVal7.length!=0) ShowBasicLogo(vAd);
	if(RefVal19.length!=0) ShowSpecialBanner(vAd);	
*/
	if (RefVal32.length+cpms_Val31.length+cpms_Val33.length+cpms_Val34.length+cpms_Val35.length+cpms_Val32.length+cpms_Val36.length+cpms_Val37.length==0){                                
					document.writeln('<div class="fl">');                      
					document.writeln(ShowFlashObject('AdLogoRight', 'lhqc_vne_180x150.swf', 180, 150));
					document.writeln('</div>');
					return;
	}              
	if(RefVal32.length!=0) ShowDropBanner();
	if(cpms_Val31.length!=0) ShowBigLogo();
	if(cpms_Val34.length!=0) ShowRightExpand(vAd);
	if(cpms_Val35.length!=0) ShowRightExpand2(vAd);
	if(cpms_Val37.length!=0) ShowSkyscraper(vAd);
	if(cpms_Val32.length!=0) ShowBigLogo2(vAd);
	if(cpms_Val33.length!=0) ShowBasicLogo(vAd);
	if(cpms_Val36.length!=0) ShowSpecialBanner(vAd);       
}

function ShowLogoLeft(vType) {
/*
	if(PAGE_FOLDER==1000){
		if (RefVal31.length>0){
			document.writeln('<div class="box-item2">');	
			ShowBigAdvHeader();			
			var alLargeLogo1 = new adlistshow(RefVal31,'LargeLogo1',0,19,0,300,250,true,1,30000);			
			document.writeln('</div>');			
		}
	}
	else{
		if (RefVal4.length>0)
		{
			document.writeln('<div class="box-item2">');	
			ShowBigAdvHeader();
			if(PAGE_FOLDER==18){
				var alLargeLogo1 = new adlistshow(RefVal4,'LargeLogo1',0,10,0,300,250,true,1,30000);
			}		
			else{
				var alLargeLogo1 = new adlistshow(RefVal4,'LargeLogo1',0,16,0,300,250,true,1,30000);				
			}
			document.writeln('</div>');
		}	
	}
*/
	if(PAGE_FOLDER==1000){
		if (RefVal31.length>0){
			document.writeln('<div class="box-item2">');	
			ShowBigAdvHeader();			
			var alLargeLogo1 = new adlistshow(RefVal31,'LargeLogo1',0,19,0,300,250,true,1,30000);			
			document.writeln('</div>');			
		}
	}
	else{
		if (cpms_Val121.length>0)
		{			
			document.writeln('<div class="box-item2">');	
			ShowBigAdvHeader();			
			var alLargeLogo1 = cpmst_adlistshow(cpms_Val121,'LargeLogo1',0,10,0,300,250,true,1,30000);				
			document.writeln('</div>');
		}	
	}
}

function ShowLogoLeft2(vType) {
/*
	if (RefVal5.length>0)
	{
		document.writeln('<div class="box-item2">');		
		ShowBigAdvHeader();
		var alLargeLogo2 = new adlistshow(RefVal5,'LargeLogo2',0,16,0,300,250,true,1,30000);
		document.writeln('</div>');		
	}
*/
	if (cpms_Val122.length>0)
	{
		document.writeln('<div class="box-item2">');		
		ShowBigAdvHeader();
		var alLargeLogo2 = new cpmst_adlistshow(cpms_Val122,'LargeLogo2',0,16,0,300,250,true,1,30000);		
		document.writeln('</div>');		
	}
}

function ShowTopLogoLeft(vType) {
/*
	if (RefVal4.length>0)
	{
		document.writeln('<div class="box-item2">');	
		ShowBigAdvHeader();
		var alLargeLogo1 = new adlistshow(RefVal4,'SlideLogo1',0,16,0,300,250,true,1,30000);
		document.writeln('</div>');		
	}
*/
	if (cpms_Val121.length>0)
	{
		document.writeln('<div class="box-item2">');	
		ShowBigAdvHeader();			
			var alLargeLogo1 = cpmst_adlistshow(cpms_Val121,'LargeLogo1',0,16,0,300,250,true,1,30000);				
		document.writeln('</div>');
	}
}

function ShowFooterBanner() {	
	if(RefVal12.length>0){		
		document.writeln('<div style="padding-bottom:5px;">');			
		var alLargeLogo1 = new adlistshow(RefVal12,'FooterBanner',0,10,0,1000,90,true,2,30000);
		document.writeln('</div>');
	}
	
/*	if(cpms_Val5.length>0){			
		document.writeln('<div style="padding-bottom:5px;">');			
		var alLargeLogo1 = new cpmst_adlistshow(cpms_Val5, 'FooterBanner', 0, 10, 0, 1000, 90, true, 2, 30000);
		document.writeln('</div>');
	}
*/
}

function ShowFixFloatBanner(vAd)
{	
	if (typeof(vAd) == 'undefined') vAd = 0;
	switch(vAd){
		case 0:
			if (RefVal23.length>0)
			{
				document.writeln('<div>');		
				var alTopBanner = new adlistshow(RefVal23,'FixFloatTopLefttBanner',0,11,0,120,300,true,1,30000);		
				document.writeln('</div>');
			}
			break;
		case 1:
			if (RefVal24.length>0)
			{
				document.writeln('<div>');		
				var alTopBanner = new adlistshow(RefVal24,'FixFloatTopRightBanner',0,12,0,120,300,true,1,30000);		
				document.writeln('</div>');
			}
			break;
		case 2:
			if (RefVal25.length>0)
			{
				document.writeln('<div>');		
				var alTopBanner = new adlistshow(RefVal25,'FixFloatBottomLeftBanner',0,13,0,120,300,true,1,30000);		
				document.writeln('</div>');
			}
			break;
		case 3:
			if (RefVal26.length>0)
			{				
				document.writeln('<div>');		
				var alTopBanner = new adlistshow(RefVal26,'FixFloatBottomRightBanner',0,14,0,120,300,true,3,30000);		
				document.writeln('</div>');
			}
			break;
	}	
	/*else
	{		
		document.writeln('<div style="float:left;width:728;">');	
		document.writeln(ShowFlashObject('AdTopBanner', 'lhqc_vne_728x90.swf', 728, 90));
		document.writeln('</div>');	
		return;
	}*/
}

function ShowSpecialExpandBanner(vAd){	
	document.writeln('<div class="fr">');
	var alTopBanner = new adlistshow(RefVal28,'SpecialExpandBanner',0,15,0,207,10,true,'undefined',30000);				
	document.writeln('</div>');
}

function ShowSlideBanner() {
	if (RefVal29.length > 0) {
		var LeftSlideBanner = new adlistshow(RefVal29,'LeftSlideBanner',0,17,0,299,900);
	}
	if (RefVal30.length > 0) {
		var RightSlideBanner = new adlistshow(RefVal30,'RightSlideBanner',0,18,0,299,900);
	}
}

function ShowDropBanner(){
	if(RefVal32.length > 0){
		document.writeln('<div style="margin-bottom:3px;">');
		var alDropBanner = new adlistshow(RefVal32,'DropBanner',0,9,0,180,1,false,0,30000);
		document.writeln('</div>');
	}
}

function ShowSkyscraper(vAd)
{              
	document.writeln('<div style="margin-bottom:3px;" class="fl">');
	if (typeof(vAd) == 'undefined') vAd = 0;                
	var alRightExpandSkyscraper = new cpmst_adlistshow(cpms_Val37,'RightExpandSkyscraperLogo2',vAd,10,0,180,600,true,1,30000);
	document.writeln('</div>');       
}

/*-----------------/Banner---------------------------*/

function changeFolder(obj){	
	location.href = obj.value;
}

function checkSite(){
	if (location.href.substr(0, 21) != 'http://vnexpress.net/' && location.href.substr(0, 25) != 'http://www.vnexpress.net/' && location.href.substr(0, 26) != 'http://beta.vnexpress.net/') location.replace('http://vnexpress.net/');
}

function ShowBigAdvHeader(){
	if (PAGE_FOLDER == 9998) 
		document.write('<div class="adBarRV">');
	else
		document.write('<div class="adv-header">');
	document.write('<div class="adv-title fl">');
	document.write('<a href="http://www.fptad.com/lienhe.aspx" target="_blank"><img style="border:0" alt="Lien he quang cao" src="/Images/Background/adv-title.gif" /></a>');
	document.write('</div>');
	document.write('</div>');
}

function setOpacity(element, opacity) {
}

var Url = {

    // public method for url encoding
    encode: function(string) {
        return escape(this._utf8_encode(string));
    },

    // public method for url decoding
    decode: function(string) {
        return this._utf8_decode(unescape(string));
    },

    // private method for UTF-8 encoding
    _utf8_encode: function(string) {
        string = string.replace(/\r\n/g, "\n");
        var utftext = "";

        for (var n = 0; n < string.length; n++) {

            var c = string.charCodeAt(n);

            if (c < 128) {
                utftext += String.fromCharCode(c);
            }
            else if ((c > 127) && (c < 2048)) {
                utftext += String.fromCharCode((c >> 6) | 192);
                utftext += String.fromCharCode((c & 63) | 128);
            }
            else {
                utftext += String.fromCharCode((c >> 12) | 224);
                utftext += String.fromCharCode(((c >> 6) & 63) | 128);
                utftext += String.fromCharCode((c & 63) | 128);
            }

        }

        return utftext;
    },

    // private method for UTF-8 decoding
    _utf8_decode: function(utftext) {
        var string = "";
        var i = 0;
        var c = c1 = c2 = 0;

        while (i < utftext.length) {

            c = utftext.charCodeAt(i);

            if (c < 128) {
                string += String.fromCharCode(c);
                i++;
            }
            else if ((c > 191) && (c < 224)) {
                c2 = utftext.charCodeAt(i + 1);
                string += String.fromCharCode(((c & 31) << 6) | (c2 & 63));
                i += 2;
            }
            else {
                c2 = utftext.charCodeAt(i + 1);
                c3 = utftext.charCodeAt(i + 2);
                string += String.fromCharCode(((c & 15) << 12) | ((c2 & 63) << 6) | (c3 & 63));
                i += 3;
            }

        }

        return string;
    }

}

function writeSociable(vLink, vTitle, vDescription, vId, SubjectID) {
	vTitle = vTitle.replace("'", "");
	vDescription = vDescription.replace("'", "");
	var strOut = "";
	strOut += "<a title=\"Facebook\" onfocus=\"this.blur();\" href=\"http://vnexpress.net/Service/Share/?sjid=" + SubjectID + "&sid=1&myurl=" + Url.encode("http://www.facebook.com/share.php%3fu=" + vLink + "%26t=" + vTitle + "") + "'\" target=\"_blank\" id=\"facebook\" rel=\"nofollow\"><img class=\"sociable-hovers\" alt=\"Facebook\" title=\"Facebook\" src=\"" + SKIN_URL + "/images/facebook.gif\"  /></a>";
	strOut += "&nbsp;&nbsp;<a onfocus=\"this.blur();\" title=\"Twitter\" href=\"http://vnexpress.net/Service/Share/?sjid=" + SubjectID + "&sid=3&myurl=" + Url.encode("http://twitter.com/home%3fstatus=" + vTitle + " - " + vLink + "") + "'\" target=\"_blank\" id=\"twitter\" rel=\"nofollow\"><img class=\"sociable-hovers\" alt=\"Twitter\" title=\"Twitter\" src=\"" + SKIN_URL + "/images/twitter.gif\"/></a>";
	strOut += "&nbsp;&nbsp;<a title=\"Google Bookmarks\" onfocus=\"this.blur();\" href=\"http://vnexpress.net/Service/Share/?sjid=" + SubjectID + "&sid=2&myurl=" + Url.encode("http://www.google.com/bookmarks/mark%3fop=edit%26amp;bkmk=" + vLink + "&amp;title=" + vTitle + "&amp;annotation=" + vDescription + "") + "\" target=\"_blank\" id=\"google\" rel=\"nofollow\"><img class=\"sociable-hovers\" alt=\"Google Bookmarks\" title=\"Google Bookmarks\" src=\"" + SKIN_URL + "/images/google.gif\"/></a>";
	strOut += "&nbsp;&nbsp;<a title=\"1280 Bookmarks\" onfocus=\"this.blur();\" href=\"http://vnexpress.net/Service/Share/?sjid=" + SubjectID + "&sid=4&myurl=" + Url.encode("http://1280.com/bookmark.php?link=" + vLink) + "\" target=\"_blank\" id=\"1280_link\" rel=\"nofollow\"><img class=\"sociable-hovers\" alt=\"1280 Bookmarks\" title=\"1280 Bookmarks\" src=\"" + SKIN_URL + "/images/1280-icon.gif\"/></a>";
	strOut += "&nbsp;&nbsp;";
	document.write(strOut);
}

function getsize(){
	var myWidth = 0, myHeight = 0;
	if(typeof(window.innerWidth) == 'number'){
		//Non-IE
		myWidth = window.innerWidth;
		myHeight = window.innerHeight;
	} 
	else if(document.documentElement && ( document.documentElement.clientWidth || document.documentElement.clientHeight )){
		//IE 6+ in 'standards compliant mode'
		myWidth = document.documentElement.clientWidth;
		myHeight = document.documentElement.clientHeight;
	} 
	else if(document.body && (document.body.clientWidth || document.body.clientHeight)){
		//IE 4 compatible
		myWidth = document.body.clientWidth;
		myHeight = document.body.clientHeight;
	}
	return new Array(myWidth, myHeight);
}
