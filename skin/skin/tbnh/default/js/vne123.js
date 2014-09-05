var iReadStep=0, iDelay=20;
var sLoDID=',', sDate='';

function getNodeValue(o){	
	try	{
		return o.item(0).firstChild.nodeValue;
	}
	catch(err) {
		return '';
	}
}

function displayid(id,add){
	if (typeof(add)=='undefined') add=true;
	if (sLoDID.indexOf(id)<=0){
		if (add) sLoDID=sLoDID.concat(id).concat(',');		
		return true;
	}
	else{
		return false;
	}
}

function getimages(Id, FileName) {
	var number = new Number(Id);
	var hexId = Hexa(number);	
	return '/Files/Subject/'.concat(hexId.substring(0,2)).concat('/').concat(hexId.substring(2,4)).concat('/').concat(hexId.substring(4,6)).concat('/').concat(hexId.substring(6,8)).concat('/').concat(FileName);			
}

function RSSLink(sId)
{
	var strLink = '';
	var strRSS = 'RSS <img class="img-rss" src="/Images/rss.gif" alt="" />'
	if(PAGE_SITE == 0)
		strLink = '<a class="link-rss" href="/RSS/GL/';
	else if(PAGE_SITE == 1)
		strLink = '<a class="link-rss" href="/RSS/HN/';
	else if(PAGE_SITE == 2)
		strLink = '<a class="link-rss" href="/RSS/SG/';	
	switch (parseInt(sId)) 
	{
		case 18: 	strLink = strLink.concat('Xa-hoi.rss">').concat(strRSS).concat('</a>'); break;
		case 2: 	strLink = strLink.concat('The-gioi.rss">').concat(strRSS).concat('</a>'); break;
		case 3: 	strLink = strLink.concat('Kinh-doanh.rss">').concat(strRSS).concat('</a>'); break;
		case 51:	strLink = strLink.concat('Van-hoa.rss">').concat(strRSS).concat('</a>'); break;
		case 9:		strLink = strLink.concat('The-thao.rss">').concat(strRSS).concat('</a>'); break;
		case 47:	strLink = strLink.concat('Phap-luat.rss">').concat(strRSS).concat('</a>'); break;
		case 110:	strLink = strLink.concat('Doi-song.rss">').concat(strRSS).concat('</a>'); break;
		case 83:	strLink = strLink.concat('Khoa-hoc.rss">').concat(strRSS).concat('</a>'); break;
		case 89:	strLink = strLink.concat('Vi-tinh.rss">').concat(strRSS).concat('</a>'); break;
		case 38:	strLink = strLink.concat('Oto-Xe-may.rss">').concat(strRSS).concat('</a>'); break;
		case 109:	strLink = strLink.concat('Ban-doc-viet.rss">').concat(strRSS).concat('</a>'); break;
		case 127:	strLink = strLink.concat('Ban-doc-viet-Tam-su.rss">').concat(strRSS).concat('</a>'); break;		
		case 105:	strLink = strLink.concat('Cuoi.rss">').concat(strRSS).concat('</a>'); break;
		default: 	strLink = ''; break;
	}	
	return strLink;
}

function showtopstories() {
	var sTimeTS;
	var arItem = new Array();	
	var sLink = ''
	if(DOMESTIC_IP==0) {
		sLink = '/ListFile/Subject/'.concat(Right(Hexa(PAGE_SITE),2)).concat('/sd_ts.xml');
	}
	else {
		sLink = '/ListFile/Subject/'.concat(Right(Hexa(PAGE_SITE),2)).concat('/so_ts.xml');
	}	
	var iMaxTS = 4;
	AjaxRequest.get(
		{
		'url':sLink
		,'onSuccess':function(req){
			if (req.responseXML.getElementsByTagName('F').length>0){
				with(req.responseXML.getElementsByTagName('F').item(0)){
					sTimeTS = getNodeValue(getElementsByTagName('T'));					
				}
			}
			var iCount=0;
			for (var i=0;i<req.responseXML.getElementsByTagName('I').length;i++){
				with(req.responseXML.getElementsByTagName('I').item(i)){
					if (iCount<iMaxTS){
						var sTemp = getNodeValue(getElementsByTagName('I'));
						if (sTemp!='' && displayid(sTemp)){
							arItem[iCount] = new Array(20);
							arItem[iCount][0] = getNodeValue(getElementsByTagName('I'));
							arItem[iCount][1] = getNodeValue(getElementsByTagName('P')) + '/';
							arItem[iCount][2] = getNodeValue(getElementsByTagName('T'));
							arItem[iCount][3] = getNodeValue(getElementsByTagName('L'));
							arItem[iCount][4] = getNodeValue(getElementsByTagName('TI'));
							arItem[iCount][5] = getNodeValue(getElementsByTagName('TW'));
							arItem[iCount][6] = getNodeValue(getElementsByTagName('TH'));
							arItem[iCount][7] = getNodeValue(getElementsByTagName('SI'));
							arItem[iCount][8] = getNodeValue(getElementsByTagName('SW'));
							arItem[iCount][9] = getNodeValue(getElementsByTagName('SH'));
							arItem[iCount][10] = getNodeValue(getElementsByTagName('LI'));
							arItem[iCount][11] = getNodeValue(getElementsByTagName('LW'));
							arItem[iCount][12] = getNodeValue(getElementsByTagName('LH'));
							arItem[iCount][13] = getNodeValue(getElementsByTagName('HV'));
							arItem[iCount][14] = getNodeValue(getElementsByTagName('HI'));
							arItem[iCount][15] = getNodeValue(getElementsByTagName('HS'));
							arItem[iCount][16] = getNodeValue(getElementsByTagName('OI'));
							arItem[iCount][17] = getNodeValue(getElementsByTagName('OW'));
							arItem[iCount][18] = getNodeValue(getElementsByTagName('OH'));
							arItem[iCount][19] = getNodeValue(getElementsByTagName('F'));
							iCount++;
						}
					}
				}
			}			
			gmobj('top4').innerHTML=gettopstoriesitem(sTimeTS,arItem);
			iReadStep=2;
		}
		,'onError':function(req){
			gmobj('top4').innerHTML=req.statusText;
			iReadStep=2;
		}
		}
	)
}

function gettopstoriesitem(sTimeTS,arItem){	
	var i;
	var sHTML='';	
	dFormat(sTimeTS);			
	sHTML=sHTML.concat('<div class="hotnews-top fl">');
	sHTML=sHTML.concat('	<div class="fl"><img src="/Images/Background/hotnews-topleft.gif" alt="" class="alt" /></div>');
	sHTML=sHTML.concat('	<div class="hotnews-topright fl">&nbsp;</div>');
	sHTML=sHTML.concat('</div>');
	sHTML=sHTML.concat('<div class="hotnews-content fl">');
	sHTML=sHTML.concat('	<div class="hotnews-detail fl">');
	sHTML=sHTML.concat('<p>');
	if(arItem[0][4]!='') {
		sHTML=sHTML.concat(BuildLink(arItem[0][19], arItem[0][1], '')).concat('<img class="img-topnews fl" src="').concat(getimages(arItem[0][0], arItem[0][4])).concat('" alt="" /></a>');		
	}
	sHTML = sHTML.concat(BuildLink(arItem[0][19], arItem[0][1], 'link-topnews')).concat(arItem[0][2]).concat('</a>');
	sHTML=sHTML.concat(showMediaIcon(arItem[0][1], arItem[0][13], arItem[0][14], 3)).concat('</p>');
	sHTML=sHTML.concat('<p>').concat(arItem[0][3].replace(/class=Lead/ig,'class=Lead1')).concat('</p>');
	sHTML=sHTML.concat('	</div>');
	sHTML=sHTML.concat('</div>');
	sHTML=sHTML.concat('<div class="hotnews-bottom fl">');
	sHTML=sHTML.concat('	<div class="hbl he4 fl">&nbsp;</div>');
	sHTML=sHTML.concat('	<div class="hotnews-bottomright fl">&nbsp;</div>');
	sHTML=sHTML.concat('</div>');
	sHTML=sHTML.concat('<div class="t3 fl">');
	for (i=1;i<=arItem.length-1;i++){
		sHTML=sHTML.concat('	<div class="t3-content fl">');
		if(arItem[i][4]!='') {
			sHTML=sHTML.concat('<p>').concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img class="img-top3" src="').concat(getimages(arItem[i][0], arItem[i][4])).concat('.thumb150x0.ns.jpg" alt="" /></a></p>');
			sHTML=sHTML.concat('<p>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-title')).concat(arItem[i][2]).concat('</a>');
			sHTML=sHTML.concat(showMediaIcon(arItem[i][1], arItem[i][13], arItem[i][14], 3)).concat('</p>');
		}
		else {
			sHTML=sHTML.concat('<p>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-title')).concat(arItem[i][2]).concat('</a></p>');
			sHTML=sHTML.concat('<p>').concat(arItem[i][3].replace(/class=Lead/ig,'class=Lead1'));
			sHTML=sHTML.concat(showMediaIcon(arItem[i][1], arItem[i][13], arItem[i][14], 3)).concat('</p>');
		}
		sHTML=sHTML.concat('	</div>');
	}
	sHTML=sHTML.concat('</div>');	
	return sHTML;
}

function writeTopDate(){	
	if(gmobj("topnewsdate")&&sDate!=''){
		gmobj("topnewsdate").innerHTML = sDate;		
	}
	else {
		setTimeout(function(){writeTopDate();},iDelay);
	}
}

function showtoplistitem(){
	var sIdTD, sNameTN, sPathTN;
	var arItem = new Array();	
	var sLink = '';
	if(DOMESTIC_IP==0) {
		sLink = '/ListFile/Subject/'.concat(Right(Hexa(PAGE_SITE),2)).concat('/sd_tn.xml');
	}
	else {
		sLink = '/ListFile/Subject/'.concat(Right(Hexa(PAGE_SITE),2)).concat('/so_tn.xml');
	}	
	var iMaxTN = 10;
	AjaxRequest.get(
		{
		'url':sLink
		,'onSuccess':function(req){
			if (req.responseXML.getElementsByTagName('F').length>0){
				with(req.responseXML.getElementsByTagName('F').item(0)){
					sIdTN = getNodeValue(getElementsByTagName('I'));
					sNameTN = toUpper(getNodeValue(getElementsByTagName('N')));
					sPathTN = getNodeValue(getElementsByTagName('P'));
				}
			}
			var iCount=0;
			for (var i=0;i<req.responseXML.getElementsByTagName('I').length;i++){
				with(req.responseXML.getElementsByTagName('I').item(i)){
					if (iCount<iMaxTN){
						var sTemp = getNodeValue(getElementsByTagName('I'));
						if (sTemp!=''){
							arItem[iCount] = new Array(20);
							arItem[iCount][0] = getNodeValue(getElementsByTagName('I'));
							arItem[iCount][1] = getNodeValue(getElementsByTagName('P')) + '/';
							arItem[iCount][2] = getNodeValue(getElementsByTagName('T'));
							arItem[iCount][3] = getNodeValue(getElementsByTagName('L'));
							arItem[iCount][4] = getNodeValue(getElementsByTagName('TI'));
							arItem[iCount][5] = getNodeValue(getElementsByTagName('TW'));
							arItem[iCount][6] = getNodeValue(getElementsByTagName('TH'));
							arItem[iCount][7] = getNodeValue(getElementsByTagName('SI'));
							arItem[iCount][8] = getNodeValue(getElementsByTagName('SW'));
							arItem[iCount][9] = getNodeValue(getElementsByTagName('SH'));
							arItem[iCount][10] = getNodeValue(getElementsByTagName('LI'));
							arItem[iCount][11] = getNodeValue(getElementsByTagName('LW'));
							arItem[iCount][12] = getNodeValue(getElementsByTagName('LH'));
							arItem[iCount][13] = getNodeValue(getElementsByTagName('HV'));
							arItem[iCount][14] = getNodeValue(getElementsByTagName('HI'));
							arItem[iCount][15] = getNodeValue(getElementsByTagName('HS'));
							arItem[iCount][16] = getNodeValue(getElementsByTagName('OI'));
							arItem[iCount][17] = getNodeValue(getElementsByTagName('OW'));
							arItem[iCount][18] = getNodeValue(getElementsByTagName('OH'));
							arItem[iCount][19] = getNodeValue(getElementsByTagName('F'));
							iCount++;
						}
					}
				}
			}
			gmobj('toplist').innerHTML=gettoplistitem(sNameTN,sPathTN,arItem);			
		}
		,'onError':function(req){
			gmobj('toplist').innerHTML=req.statusText;			
		}
		}
	)
}

function gettoplistitem(sNameTN,sPathTN,arItem){		
	var sHTML='';	
	sHTML=sHTML.concat('<ul>');
	for (var i=0;i<=arItem.length-1;i++){
		sHTML=sHTML.concat('<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-toplist')).concat(arItem[i][2]).concat('</a>');
		if(arItem[i][13]>0){
			sHTML=sHTML.concat('&nbsp;<img src="/Images/video2.gif" alt="" />');
		}
		if(arItem[i][14]>0){
			sHTML=sHTML.concat('&nbsp;<img src="/Images/photo2.gif" alt="" />');
		}
		sHTML=sHTML.concat('</li>');
	}
	sHTML=sHTML.concat('</ul>');	
	return sHTML;	
}

function showhomefolderitem(sFolder){
	iReadStep = 2
	if (iReadStep<2) {	
		setTimeout(function(){showhomefolderitem(sFolder);},iDelay);
		return;
	}
	var sId, sName, sPath;
	var arItem = new Array();	
	var sLink = '';
	if(DOMESTIC_IP==0) {
		sLink = '/ListFile/Subject/'.concat(Right(Hexa(PAGE_SITE),2)).concat('/sd_').concat(sFolder).concat('.xml');
	}
	else {
		sLink = '/ListFile/Subject/'.concat(Right(Hexa(PAGE_SITE),2)).concat('/so_').concat(sFolder).concat('.xml');
	}
	var sHTML;
	var iMaxItem;
	switch (parseInt(sFolder)){
		case 15: case 16: case 25: 
			iMaxItem = 1; break;
		case 110: case 400: 
			iMaxItem = 4; break;
		case 2: case 3: case 9: case 18: case 38: case 47: case 51: case 83: case 89: case 127: 
			iMaxItem = 5; break;
		case 1001: 
			iMaxItem = 7;break;		
		case 105:
			iMaxItem = 2; break;		
		default: 
			iMaxItem = 3;
	}
	AjaxRequest.get(
		{
	    'url':sLink
	    ,'onSuccess':function(req){			
	    	if (req.responseXML.getElementsByTagName('F').length>0){				
	    		with(req.responseXML.getElementsByTagName('F').item(0)){
					sId = getNodeValue(getElementsByTagName('I'));
					sName = toUpper(getNodeValue(getElementsByTagName('N')));
					sPath = getNodeValue(getElementsByTagName('P'));					
	    		}
	    	}
	    	var iCount=0;
	    	for (var i=0;i<req.responseXML.getElementsByTagName('I').length;i++){
	    		with(req.responseXML.getElementsByTagName('I').item(i)){
	    			if (iCount<iMaxItem){
		    			var sTemp = getNodeValue(getElementsByTagName('I'));
		    			if (sTemp!='' && displayid(sTemp)){
			    			arItem[iCount] = new Array(20);
							arItem[iCount][0] = getNodeValue(getElementsByTagName('I'));
							arItem[iCount][1] = getNodeValue(getElementsByTagName('P')) + '/';
							arItem[iCount][2] = getNodeValue(getElementsByTagName('T'));
							arItem[iCount][3] = getNodeValue(getElementsByTagName('L'));
							arItem[iCount][4] = getNodeValue(getElementsByTagName('TI'));
							arItem[iCount][5] = getNodeValue(getElementsByTagName('TW'));
							arItem[iCount][6] = getNodeValue(getElementsByTagName('TH'));
							arItem[iCount][7] = getNodeValue(getElementsByTagName('SI'));
							arItem[iCount][8] = getNodeValue(getElementsByTagName('SW'));
							arItem[iCount][9] = getNodeValue(getElementsByTagName('SH'));
							arItem[iCount][10] = getNodeValue(getElementsByTagName('LI'));
							arItem[iCount][11] = getNodeValue(getElementsByTagName('LW'));
							arItem[iCount][12] = getNodeValue(getElementsByTagName('LH'));
							arItem[iCount][13] = getNodeValue(getElementsByTagName('HV'));
							arItem[iCount][14] = getNodeValue(getElementsByTagName('HI'));
							arItem[iCount][15] = getNodeValue(getElementsByTagName('HS'));		
							arItem[iCount][16] = getNodeValue(getElementsByTagName('OI'));
							arItem[iCount][17] = getNodeValue(getElementsByTagName('OW'));
							arItem[iCount][18] = getNodeValue(getElementsByTagName('OH'));
							arItem[iCount][19] = getNodeValue(getElementsByTagName('F'));
							iCount++;
						}
					}
	    		}
	    	}
	    	switch (parseInt(sFolder)){	    						
				case 400: sHTML = getphotofolder(sId,sName,sPath,arItem);break;
	    		default: sHTML = gethomefolderitem(sId,sName,sPath,arItem); break;
	    	}			
			gmobj('tdHomeFolder'+sFolder).innerHTML=sHTML;			
			switch (parseInt(sFolder)) {
				//case 3: showsubfolder(5); break;				
				//case 9: showsubfolder(121); break;						
				case 110: showsubfolder(151); break;				
				default: break;
			}			
	    }
	    ,'onError':function(req){
			gmobj('tdHomeFolder'.concat(sFolder)).innerHTML=req.statusText;			
			}
		}
	)
}

function gethomefolderitem(sId,sName,sPath,arItem) {
	var sHTML = '';
	var i=0;
	
	if(sId==105) {
		while(i<arItem.length) {
			sHTML = sHTML.concat('<p>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-title')).concat(arItem[i][2]).concat('</a></p> ');
			sHTML = sHTML.concat('<p>').concat(arItem[i][3].replace(/class=Lead/ig,'class=Lead1')).concat('</p>');			
			i++;
		}
	}	
	else if(sId==109) {
		while(i<arItem.length) {
			if(i==0) {
				sHTML = sHTML.concat('	<div class="folder-topnews2 fl">');
				if(arItem[i][7] != '') {			
					sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img class="img-subject fl" src="').concat(getimages(arItem[i][0], arItem[i][7])).concat('" alt="" /></a>');					
				}
				sHTML = sHTML.concat('<p>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-title')).concat(arItem[i][2]).concat('</a>');
				sHTML = sHTML.concat(showMediaIcon(arItem[i][1], arItem[i][13], arItem[i][14], 0)).concat('</p>');
				sHTML = sHTML.concat('<p>').concat(arItem[i][3].replace(/class=Lead/ig,'class=Lead1')).concat('</p>');
				sHTML = sHTML.concat('	</div>');
			}
			else {
				if(i==1) {
					sHTML = sHTML.concat('	<div class="folder-othernews2 fl" style="padding-top:5px;">');
					sHTML = sHTML.concat('		<ul>');
					sHTML = sHTML.concat('			<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');
				}
				else if(i!=arItem.length-1) {
					sHTML = sHTML.concat('			<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');					
				}
				else {
					sHTML = sHTML.concat('			<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');
					sHTML = sHTML.concat('		</ul>');
					sHTML = sHTML.concat('	</div>');
				}
			}
			i++;
		}
	}
	else {			
		sHTML = sHTML.concat('	<div class="folder-topnews fl">');	
		if(arItem[i][7] != '') {			
			sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img class="img-subject fl" src="').concat(getimages(arItem[i][0], arItem[i][7])).concat('" alt="" /></a>');					
		}
		sHTML = sHTML.concat('<p>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-title')).concat(arItem[i][2]).concat('</a>');
		sHTML = sHTML.concat(showMediaIcon(arItem[i][1], arItem[i][13], arItem[i][14], 0)).concat('</p>');
		sHTML = sHTML.concat('<p>').concat(arItem[i][3].replace(/class=Lead/ig,'class=Lead1')).concat('</p>');
		sHTML = sHTML.concat('	</div>');		
		sHTML = sHTML.concat(getothernews(sId,sName,sPath,arItem));		
	}
	if(sId!=110){
		sHTML = sHTML.concat('	<div class="rss fr">').concat(RSSLink(sId)).concat('</div>');
	}
	else {
		sHTML = sHTML.concat('	<div class="rss fr">');
		sHTML = sHTML.concat('<div class="fl"><img src="/Images/Menu/black-triangle.gif" alt="" />&nbsp;').concat('<a class="link-othernews3" href="/GL/Suc-khoe/Tu-van/">T&#432; v&#7845;n s&#7913;c kh&#7887;e</a>');
		sHTML = sHTML.concat('&nbsp;&nbsp;&nbsp;<img src="/Images/Menu/black-triangle.gif" alt="" />&nbsp;').concat('<a class="link-othernews3" href="/GL/Doi-song/Tu-van-nuoi-day-tre/">T&#432; v&#7845;n nu&#244;i d&#7841;y tr&#7867;</a></div>');
		sHTML = sHTML.concat(RSSLink(sId)).concat('</div>');
	}
	sHTML = sHTML.concat('</div>');	
	return sHTML;
}

function getothernews(sId,sName,sPath,arItem) {
	var sHTML = '';
	var i=1;
	switch (parseInt(sId)){
		case 2: case 3: case 9: case 18: case 38: case 47: 
			while(i<arItem.length){
				if(i==1) {
					sHTML = sHTML.concat('	<div class="folder-othernews fl">');					
					if(arItem[i][7] != '' || arItem[i][10] != ''){
						sHTML = sHTML.concat('<div class="other-folder fl">');
						if(arItem[i][10] != '') {
						sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img class="img-other fl" src="').concat(getimages(arItem[i][0], arItem[i][10])).concat('" alt="" /></a>');
						}
						else {
							sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img class="img-other fl" src="').concat(getimages(arItem[i][0], arItem[i][7])).concat('" alt="" /></a>');
						}
						sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a>');
						sHTML = sHTML.concat(showMediaIcon(arItem[i][1], arItem[i][13], arItem[i][14], 0));
						sHTML = sHTML.concat('</div>');
						sHTML = sHTML.concat('<div class="fl">');
						sHTML = sHTML.concat('	<ul>');
					}	
					else{
						sHTML = sHTML.concat('		<div class="fl">');
						sHTML = sHTML.concat('			<ul>');
						sHTML = sHTML.concat('				<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');
					}
				}
				else if(i!=arItem.length-1) {
					sHTML = sHTML.concat('				<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');
				}
				else {
					sHTML = sHTML.concat('				<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');
					sHTML = sHTML.concat('			</ul>');
					sHTML = sHTML.concat('		</div>');
					sHTML = sHTML.concat('	</div>');
				}
				i++;
			}
			break;
		// case 3:
			// while(i<arItem.length){
				// if(i==1) {
					// sHTML = sHTML.concat('	<div class="folder-othernews fl">');					
					// sHTML = sHTML.concat('		<div class="other-folder fl" id="HomeFolder5"></div>');					
					// sHTML = sHTML.concat('		<div class="fl">');
					// sHTML = sHTML.concat('			<ul>');
					// sHTML = sHTML.concat('				<li><a href="').concat(arItem[i][1]).concat('" class="link-othernews">').concat(arItem[i][2]).concat('</a></li>');
				// }
				// else if(i!=arItem.length-1) {
					// sHTML = sHTML.concat('				<li><a href="').concat(arItem[i][1]).concat('" class="link-othernews">').concat(arItem[i][2]).concat('</a></li>');
				// }
				// else {
					// sHTML = sHTML.concat('				<li><a href="').concat(arItem[i][1]).concat('" class="link-othernews">').concat(arItem[i][2]).concat('</a></li>');
					// sHTML = sHTML.concat('			</ul>');
					// sHTML = sHTML.concat('		</div>');
					// sHTML = sHTML.concat('	</div>');
				// }
				// i++;
			// }
			// break;				
		case 110:
			while(i<arItem.length){
				if(i==1) {
					sHTML = sHTML.concat('	<div class="folder-othernews fl">');
					sHTML = sHTML.concat('		<div class="fl">');
					sHTML = sHTML.concat('			<ul>');
					sHTML = sHTML.concat('				<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');
				}
				else if(i!=arItem.length-1) {
					sHTML = sHTML.concat('				<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');
				}
				else {
					sHTML = sHTML.concat('				<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');
					sHTML = sHTML.concat('			</ul>');
					sHTML = sHTML.concat('		</div>')
					sHTML = sHTML.concat('		<div class="other-folder2 fl" id="HomeFolder151"></div>');
					sHTML = sHTML.concat('	</div>');
				}
				i++;
			}
			break;		
		default:
			while(i<arItem.length){
				if(i==1) {
					sHTML = sHTML.concat('	<div class="folder-othernews fl">');
					sHTML = sHTML.concat('		<ul>');
					sHTML = sHTML.concat('			<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');
				}
				else if(i!=arItem.length-1) {
					sHTML = sHTML.concat('			<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');
				}
				else {
					sHTML = sHTML.concat('			<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');
					sHTML = sHTML.concat('		</ul>');
					sHTML = sHTML.concat('	</div>');
				}
				i++;
			}
			break;
	}
	return	sHTML;
}

function getphotofolder(sId,sName,sPath,arItem){
	var sHTML = '';	
	var i=0;	
	while (i<arItem.length){
		if(i==0){
			sHTML = sHTML.concat('<div class="box-middle1 folder-photo fl">');
			sHTML = sHTML.concat('		<p><a href="').concat(arItem[i][1]).concat('">').concat(arItem[i][2]).concat('</a></p>');
			sHTML = sHTML.concat('		<p><a href="').concat(arItem[i][1]).concat('"><img src="').concat(getimages(arItem[i][0], arItem[i][16])).concat('"/></a></p>');
			sHTML = sHTML.concat('</div>');
		}		
		else {
			if(i==1) {	
				sHTML = sHTML.concat('<div class="box-middle1 list-item fl">');				
				sHTML = sHTML.concat('		<ul>');
				sHTML = sHTML.concat('			<li><a class="link-othernews3" href="').concat(arItem[i][1]).concat('">').concat(arItem[i][2]).concat('</a></li>');
			}			
			else if(i!=arItem.length-1) {
				sHTML = sHTML.concat('			<li><a class="link-othernews3" href="').concat(arItem[i][1]).concat('">').concat(arItem[i][2]).concat('</a></li>');
			}
			else {
				sHTML = sHTML.concat('			<li><a class="link-othernews3" href="').concat(arItem[i][1]).concat('">').concat(arItem[i][2]).concat('</a></li>');
				sHTML = sHTML.concat('		</ul>');
				sHTML = sHTML.concat('	</div>')				
			}
		}
		i++;
	}		
	return sHTML;
}

function showsubfolder(sFolder){		
	var sId, sName, sPath;
	var arItem = new Array();	
	var sLink = '';
	if(DOMESTIC_IP==0) {
		sLink = '/ListFile/Subject/'.concat(Right(Hexa(PAGE_SITE),2)).concat('/sd_').concat(sFolder).concat('.xml');
	}
	else {
		sLink = '/ListFile/Subject/'.concat(Right(Hexa(PAGE_SITE),2)).concat('/so_').concat(sFolder).concat('.xml');
	}
	var sHTML;
	var iMaxItem;
	switch (parseInt(sFolder)){
		case 10: case 14: iMaxItem = 2; break;		
		case 121: iMaxItem = 4; break;			
		default: iMaxItem = 1; break;
	}			
	AjaxRequest.get(
		{
	    'url':sLink
	    ,'onSuccess':function(req){			
	    	if (req.responseXML.getElementsByTagName('F').length>0){				
	    		with(req.responseXML.getElementsByTagName('F').item(0)){
					sId = getNodeValue(getElementsByTagName('I'));
					sName = toUpper(getNodeValue(getElementsByTagName('N')));
					sPath = getNodeValue(getElementsByTagName('P'));					
	    		}
	    	}
	    	var iCount=0;
	    	for (var i=0;i<req.responseXML.getElementsByTagName('I').length;i++){
	    		with(req.responseXML.getElementsByTagName('I').item(i)){
	    			if (iCount<iMaxItem){
		    			var sTemp = getNodeValue(getElementsByTagName('I'));
		    			if (sTemp!='' && displayid(sTemp)){
			    			arItem[iCount] = new Array(20);
							arItem[iCount][0] = getNodeValue(getElementsByTagName('I'));
							arItem[iCount][1] = getNodeValue(getElementsByTagName('P')) + '/';
							arItem[iCount][2] = getNodeValue(getElementsByTagName('T'));
							arItem[iCount][3] = getNodeValue(getElementsByTagName('L'));
							arItem[iCount][4] = getNodeValue(getElementsByTagName('TI'));
							arItem[iCount][5] = getNodeValue(getElementsByTagName('TW'));
							arItem[iCount][6] = getNodeValue(getElementsByTagName('TH'));
							arItem[iCount][7] = getNodeValue(getElementsByTagName('SI'));
							arItem[iCount][8] = getNodeValue(getElementsByTagName('SW'));
							arItem[iCount][9] = getNodeValue(getElementsByTagName('SH'));
							arItem[iCount][10] = getNodeValue(getElementsByTagName('LI'));
							arItem[iCount][11] = getNodeValue(getElementsByTagName('LW'));
							arItem[iCount][12] = getNodeValue(getElementsByTagName('LH'));
							arItem[iCount][13] = getNodeValue(getElementsByTagName('HV'));
							arItem[iCount][14] = getNodeValue(getElementsByTagName('HI'));
							arItem[iCount][15] = getNodeValue(getElementsByTagName('HS'));
							arItem[iCount][16] = getNodeValue(getElementsByTagName('OI'));
							arItem[iCount][17] = getNodeValue(getElementsByTagName('OW'));
							arItem[iCount][18] = getNodeValue(getElementsByTagName('OH'));
							arItem[iCount][19] = getNodeValue(getElementsByTagName('F'));
							iCount++;
						}
					}
	    		}
	    	}	
			sHTML = getsubfolder(sId, sName, sPath, arItem, sFolder);
			gmobj('HomeFolder'.concat(sFolder)).innerHTML=sHTML;			
	    }
	    ,'onError':function(req){
			gmobj('HomeFolder'.concat(sFolder)).innerHTML=req.statusText;			
			}
		}
	)
}

function getsubfolder(sId, sName, sPath, arItem, sFolder){
	var sHTML = '';
	var i=0;
	switch(parseInt(sFolder)){
		case 5: case 151:
			if(arItem[i][10] != '') {
				sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img class="img-other fl" src="').concat(getimages(arItem[i][0], arItem[i][10])).concat('" alt="" /></a>');
			}
			else if(arItem[i][7] != '') {
				sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img class="img-other fl" src="').concat(getimages(arItem[i][0], arItem[i][7])).concat('" alt="" /></a>');
			}
			if(parseInt(sFolder)==5){
				sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a>');
				sHTML = sHTML.concat(showMediaIcon(arItem[i][1], arItem[i][13], arItem[i][14], 1));
			}
			else {
				sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[0][2]).concat('</a>');	
			}			
			break;
		case 121:
			while(i<arItem.length){
				if(i==0) {
					sHTML = sHTML.concat('	<div class="folder-othernews fl">');					
					if(arItem[i][7] != '' || arItem[i][10] != ''){
						sHTML = sHTML.concat('<div class="other-folder fl">');
						if(arItem[i][10] != '') {
						sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img class="img-other fl" src="').concat(getimages(arItem[i][0], arItem[i][10])).concat('" alt="" /></a>');
						}
						else {
							sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img class="img-other fl" src="').concat(getimages(arItem[i][0], arItem[i][7])).concat('" alt="" /></a>');
						}
						sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a>');
						sHTML = sHTML.concat(showMediaIcon(arItem[i][1], arItem[i][13], arItem[i][14], 0));
						sHTML = sHTML.concat('</div>');
						sHTML = sHTML.concat('<div class="fl">');
						sHTML = sHTML.concat('	<ul>');
					}	
					else{
						sHTML = sHTML.concat('		<div class="fl">');
						sHTML = sHTML.concat('			<ul>');
						sHTML = sHTML.concat('				<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');
					}
				}
				else if(i!=arItem.length-1) {
					sHTML = sHTML.concat('				<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');
				}
				else {
					sHTML = sHTML.concat('				<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');
					sHTML = sHTML.concat('			</ul>');
					sHTML = sHTML.concat('		</div>');
					sHTML = sHTML.concat('	</div>');
				}
				i++;
			}
			break;
		case 10: case 14:
			sHTML = sHTML.concat('<ul>');
			while (i<arItem.length) {
				sHTML = sHTML.concat('	<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews')).concat(arItem[i][2]).concat('</a></li>');
				i++;
			}
			sHTML = sHTML.concat('</ul>');
			break;
		default: break;
	}
	return sHTML;
}

function changeChannel(objObject){
	showIPTV(objObject.value);
}

function showIPTV(ExLocalID){	
	var sUrl = 'http://www.thoibaonganhang.vn';
	var sDate = '';
	var channel = '';
	var arItem = new Array();	
	var sLink = sUrl + '/ListFile/iTV/' + ExLocalID + '.xml';
	AjaxRequest.get(
		{
		'url':sLink
		,'onSuccess':function(req){			
			sDate = getNodeValue(req.responseXML.getElementsByTagName('Date'));										    	
			if(req.responseXML.getElementsByTagName('Items').length>0) {				
				for(var i=0; i<req.responseXML.getElementsByTagName('Items').length; i++) {
					if(req.responseXML.getElementsByTagName('Items')[i].getAttribute("ID")==ExLocalID){
						channel = req.responseXML.getElementsByTagName('Items')[i].getAttribute("NAME");
						var iCount=0;
						for(var j=0; j<req.responseXML.getElementsByTagName('Items')[i].getElementsByTagName('Item').length; j++) {
							arItem[iCount] = new Array(2);
							arItem[iCount][0] = getNodeValue(req.responseXML.getElementsByTagName('Items')[i].getElementsByTagName('Item')[j].getElementsByTagName('TVTime'));
							arItem[iCount][1] = getNodeValue(req.responseXML.getElementsByTagName('Items')[i].getElementsByTagName('Item')[j].getElementsByTagName('Desc'));								
							iCount++;
						}
						
						break;
					}
				}
			}
			gmobj("iptv-channel").innerHTML=getIPTV(ExLocalID,sDate, channel, arItem);
			gmobj("iptv-channel").scrollTop=0;
		}
		,'onError':function(req){gmobj("iptv-channel").innerHTML=req.statusText;}
		}
	)
}

function getIPTV(ExLocalID,sDate, channel, arItem){	
	var sHTML = '';
	
	sHTML = sHTML.concat('<table border=0 cellpadding=0 cellspacing=3 width=100%>');
	sHTML = sHTML.concat('<tr height=20><td colspan=2 class="Time" style="padding-left:3;font-size:11px"><b>').concat(channel).concat(' (').concat(sDate).concat(')</b></td></tr>');
	sHTML = sHTML.concat('<tr height=1><td colspan=2 bgcolor="#666666"></td></tr>');
	if(arItem.length > 0) {
		for(var i=0; i<arItem.length; i++){
			sHTML = sHTML.concat('<tr>');
			sHTML = sHTML.concat('<td style="padding-left:3; padding-right:5;" valign=top width=15 align=center class="Image" style="font: 11px arial;"><b>').concat(arItem[i][0]).concat('</b></td>');
			sHTML = sHTML.concat('<td valign=top class="Image" width="100%"><font color="#06175D"  style="font:11px arial;">').concat(arItem[i][1]).concat('</font></td>');
			sHTML = sHTML.concat('</tr>');
		}
	}
	else {
		sHTML = sHTML.concat('<tr>');
		sHTML = sHTML.concat('<td colspan=2 style="padding-left:3; padding-right:5;" valign=top align=left class="Image" style="font-size:11px"><font color="#06175D">Ch&#432;a c&#243; l&#7883;ch</font></td>');
		sHTML = sHTML.concat('</tr>');	
	}
	sHTML = sHTML.concat('</table>');
	
	return sHTML;
}

function ShowTopicJS(vFolderID, vItemCount, vType1, vType2, vCustomTitle, vPageCheck, vObjectID, vShowHeader, vSubjectID){
	var sId, sTitle, iCount=0, iMaxItem=10;
	var arItem = new Array();
	var sLink = '';
	var vHId='';	
	vHId = Hexa(vFolderID);	
	vHId = vHId.substring(vHId.length-6,vHId.length);	
	vHId = vHId.substring(0,2) + "/" + vHId.substring(2,4) + "/" + vHId.substring(4,6) + "/";	
	if(DOMESTIC_IP==0) {		
		sLink = sLink + '/ListFile/Topic/' + vHId + 'sd_' + PAGE_SITE + '.xml';		
	}
	else {		
		sLink = sLink + '/ListFile/Topic/' + vHId + 'so_' + PAGE_SITE + '.xml';				
	}	
	
	var sHTML;

	AjaxRequest.get(
		{
			'url':sLink
			,'onSuccess':function(req){				
				if (req.responseXML.getElementsByTagName('T').length>0){
					with(req.responseXML.getElementsByTagName('T').item(0)){
						sId = getNodeValue(getElementsByTagName('I'));
						sTitle= getNodeValue(getElementsByTagName('T'));
						sDate = getNodeValue(getElementsByTagName('D'));
					}
				}
				var iCount=0;				
				for (var i=0;i<req.responseXML.getElementsByTagName('I').length;i++){
					with(req.responseXML.getElementsByTagName('I').item(i)){					
						if (iCount<iMaxItem && iCount<vItemCount){	
							var sTemp = getNodeValue(getElementsByTagName('P'));
							var sTemps = new Array();
							sTemps = sTemp.split('/');							
							if (sTemps[sTemps.length-1]!='' && displayid(HexToDec(sTemps[sTemps.length-1]))){								
								arItem[iCount] = new Array(3);
								arItem[iCount][0] = getNodeValue(getElementsByTagName('T'));
								arItem[iCount][1] = getNodeValue(getElementsByTagName('P')) + '/';
								arItem[iCount][2] = getNodeValue(getElementsByTagName('D'));							
								iCount++;							
							}
						}
					}
				}
			
				gmobj(vObjectID).innerHTML = GetTopicHTML(sId,sTitle,sDate,arItem,vType1,vType2,vCustomTitle,vShowHeader);
			}
			,'onError':function(req){gmobj(vObjectID).innerHTML=req.statusText;}
		}
	)
}

function GetTopicHTML(sId,sTitle,sDate,arItem,vType1,vType2,vCustomTitle,vShowHeader){
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
			sTableTopicTitle += '<tr><td class="OtherTitle" height="40" valign="middle">'+vCustomTitle+':</td></tr>';
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
			//sHTML += '<tr><td><a href="/Topic/?ID='+sId+'" class="TopicTitle">'+sTitle+'</a><span class="ShowDate">&nbsp;('+sDate+')</span></td></tr>';
			if(PAGE_SITE==0) {
				sHTML += '<tr><td><a href="/tin-tuc/Topic/?ID='+sId+'" class="TopicTitle">'+sTitle+'</a><span class="ShowDate">&nbsp;('+dmy(sDate)+')</span></td></tr>';
			}
			else if(PAGE_SITE==1) {
				sHTML += '<tr><td><a href="/HN/Topic/?ID='+sId+'" class="TopicTitle">'+sTitle+'</a><span class="ShowDate">&nbsp;('+dmy(sDate)+')</span></td></tr>';
			}
			else if(PAGE_SITE==2) {
				sHTML += '<tr><td><a href="/SG/Topic/?ID='+sId+'" class="TopicTitle">'+sTitle+'</a><span class="ShowDate">&nbsp;('+dmy(sDate)+')</span></td></tr>';
			}
			sHTML += '</table>';
			break;
		case 2: // ' Subject
			sHTML += sTableTopicTitle;
			sHTML += '<table border="0" cellpadding="2" cellspacing="0" width="96%">';
			while (i<arItem.length)
			{
				sHTML += '<tr>'+sTdBullet+'<td><a class="Other" href="'+arItem[i][1]+'">'+arItem[i][0]+'</a><span class="ShowDate">&nbsp;('+dmy(arItem[i][2])+')</span></td></tr>';
				i++;
			}
			sHTML += '</table>';
			break;
		case 3: // ' Topic + Subject
			sHTML += sTableTopicTitle;
			sHTML += '<table border="0" cellpadding="2" cellspacing="0" width="96%">';			
			if(PAGE_SITE==0) {
				sHTML += '<tr><td><a href="/tin-tuc/Topic/?ID='+sId+'" class="TopicTitle">'+sTitle+'</a><span class="ShowDate">&nbsp;('+dmy(sDate)+')</span></td></tr>';
			}
			else if(PAGE_SITE==1) {
				sHTML += '<tr><td><a href="/HN/Topic/?ID='+sId+'" class="TopicTitle">'+sTitle+'</a><span class="ShowDate">&nbsp;('+dmy(sDate)+')</span></td></tr>';
			}
			else if(PAGE_SITE==2) {
				sHTML += '<tr><td><a href="/SG/Topic/?ID='+sId+'" class="TopicTitle">'+sTitle+'</a><span class="ShowDate">&nbsp;('+dmy(sDate)+')</span></td></tr>';
			}
			while (i<arItem.length)
			{
				sHTML += '<tr><td><table border="0" width="100%" cellpadding="2" cellspacing="0"><tr>'+sTdBullet+'<td><a class="Other" href="'+arItem[i][1]+'">'+arItem[i][0]+'</a><span class="ShowDate">&nbsp;('+dmy(arItem[i][2])+')</span></td></tr></table></td></tr>';
				i++;
			}
			sHTML += '</table>';
			break;
		case 4: // ' Subject (before)
			sHTML += sTableTopicTitle;
			sHTML += '<table border="0" cellpadding="2" cellspacing="0" width="96%">';
			while (i<arItem.length)
			{
				sHTML += '<tr><td><table border="0" width="100%" cellpadding="2" cellspacing="0"><tr>'+sTdBullet+'<td><a class="Other" href="'+arItem[i][1]+'">'+arItem[i][0]+'</a><span class="ShowDate">&nbsp;('+dmy(arItem[i][2])+')</span></td></tr></table></td></tr>';
				i++;
			}
			if(PAGE_SITE==0) {
				sHTML += '<tr><td><table border="0" width="100%" cellpadding="2" cellspacing="0"><tr><td align="right"><a class="Other" href="/tin-tuc/Topic/?ID='+sId+'">Xem ti&#7871;p</a></td></tr></table></td></tr>';
			}
			else if(PAGE_SITE==1) {
				sHTML += '<tr><td><table border="0" width="100%" cellpadding="2" cellspacing="0"><tr><td align="right"><a class="Other" href="/HN/Topic/?ID='+sId+'">Xem ti&#7871;p</a></td></tr></table></td></tr>';
			}
			else if(PAGE_SITE==2) {
				sHTML += '<tr><td><table border="0" width="100%" cellpadding="2" cellspacing="0"><tr><td align="right"><a class="Other" href="/SG/Topic/?ID='+sId+'">Xem ti&#7871;p</a></td></tr></table></td></tr>';
			}
			sHTML += '</table>';
			break;
		case 5: // ' Topic + Subject (before)
			sHTML += sTableTopicTitle;
			sHTML += '<table border="0" cellpadding="2" cellspacing="0" width="96%">';
			//sHTML += '<tr><td><a href="/Topic/?ID='+sId+'" class="TopicTitle">'+sTitle+'</a><span class="ShowDate">&nbsp;('+sDate+')</span></td></tr>';
			if(PAGE_SITE==0) {
				sHTML += '<tr><td><a href="/tin-tuc/Topic/?ID='+sId+'" class="TopicTitle">'+sTitle+'</a><span class="ShowDate">&nbsp;('+dmy(sDate)+')</span></td></tr>';
			}
			else if(PAGE_SITE==1) {
				sHTML += '<tr><td><a href="/HN/Topic/?ID='+sId+'" class="TopicTitle">'+sTitle+'</a><span class="ShowDate">&nbsp;('+dmy(sDate)+')</span></td></tr>';
			}
			else if(PAGE_SITE==2) {
				sHTML += '<tr><td><a href="/SG/Topic/?ID='+sId+'" class="TopicTitle">'+sTitle+'</a><span class="ShowDate">&nbsp;('+dmy(sDate)+')</span></td></tr>';
			}
			while (i<arItem.length)
			{
				sHTML += '<tr><td><table border="0" width="100%" cellpadding="2" cellspacing="0"><tr>'+sTdBullet+'<td><a class="Other" href="'+arItem[i][1]+'">'+arItem[i][0]+'</a><span class="ShowDate">&nbsp;('+dmy(arItem[i][2])+')</span></td></tr></table></td></tr>';
				i++;
			}			
			if(PAGE_SITE==0) {
				sHTML += '<tr><td align="right"><a class="Other" href="/tin-tuc/Topic/?ID='+sId+'">Xem ti&#7871;p</a></td></tr>';
			}
			else if(PAGE_SITE==1) {
				sHTML += '<tr><td align="right"><a class="Other" href="/HN/Topic/?ID='+sId+'">Xem ti&#7871;p</a></td></tr>';
			}
			else if(PAGE_SITE==2) {
				sHTML += '<tr><td align="right"><a class="Other" href="/SG/Topic/?ID='+sId+'">Xem ti&#7871;p</a></td></tr>';
			}
			sHTML += '</table>';
			break;
	}

	return sHTML;
}

function showMediaIcon(path, ivideo, iphoto, type) {
	var strIcon = ''
	if(type==0) {
		if(ivideo > 0 || iphoto > 0) {
			strIcon=strIcon.concat('&nbsp;<a style="text-decoration:none" href="').concat(path).concat('">');		
			if(ivideo > 0){
				strIcon=strIcon.concat('<img border="0" src="/Images/video.gif" />&nbsp;&nbsp;');
			}						
			if(iphoto > 0){
				strIcon=strIcon.concat('<img border="0" src="/Images/photo.gif" />&nbsp;&nbsp;');
			}
			strIcon = strIcon.concat('</a>');
		}
	}
	else if(type==1) {
		if(ivideo > 0){
			strIcon=strIcon.concat('&nbsp;&nbsp;<img border="0" src="/Images/video.gif" align="middle" />');
		}						
		if(iphoto > 0){
			strIcon=strIcon.concat('&nbsp;&nbsp;<img border="0" src="/Images/photo.gif" align="middle" />');
		}
	}
	else if(type==2) {
		if(ivideo > 0){
			strIcon=strIcon.concat('<img border="0" src="/Images/video.gif" />&nbsp;&nbsp;');
		}						
		if(iphoto > 0){
			strIcon=strIcon.concat('<img border="0" src="/Images/photo.gif" />&nbsp;&nbsp;');
		}		
	}
	else if(type==3) {
		if(ivideo > 0){
			strIcon=strIcon.concat('&nbsp;<img border="0" src="/Images/video.gif" />');
		}						
		if(iphoto > 0){
			strIcon=strIcon.concat('&nbsp;<img border="0" src="/Images/photo.gif" />');
		}		
	}
	return strIcon;
}

function showAdWord(FolderId) {
	if(FolderId < 0) {
		FolderId = 0;
	}
	var sLink = '';	
	var arItem = new Array();
	var iMaxItem = 16;
	sLink = '/ListFile/AdWord/' + FolderId + '.xml';	
	AjaxRequest.get(
		{
		'url':sLink
		,'onSuccess':function(req){			
			if(req.responseXML.getElementsByTagName('I').length>0) {
				var arr0 = new Array();
				var arr1 = new Array();
				var iCount=0;				
				for (var i=0;i<req.responseXML.getElementsByTagName('I').length;i++){
					with(req.responseXML.getElementsByTagName('I').item(i)){
						//if(iCount < iMaxItem){
							var sTemp = getNodeValue(getElementsByTagName('I'));
							var priority = getNodeValue(getElementsByTagName('P'));
							if (sTemp!=''){								
								arItem[iCount] = new Array(2);								
								arItem[iCount][0] = getNodeValue(getElementsByTagName('I'));
								arItem[iCount][1] = getNodeValue(getElementsByTagName('T'));																				
								
								if (priority == '1' && arr1.length < iMaxItem)
									arr1[arr1.length] = arItem[iCount];									
								else if (priority == '0' && arr0.length < iMaxItem)
									arr0[arr0.length] = arItem[iCount];
								iCount++;
							}
						//}
					}		    		
		    }
			}
			gmobj("AdWord").innerHTML=getAdWord(arr1.concat(arr0), FolderId);			
		}
		,'onError':function(req){}
		}
	)
}

function getAdWord(arItem, FolderId){
	var sHTML = '';
	var Link = '/User/Rao-vat/Source/View.Asp?ID=';
	var i=0;
	
	i = 0;
	sHTML = sHTML.concat('<ul>');
	while(i<arItem.length && i<16) {				
		sHTML = sHTML.concat('<li><a class="link-othernews2" href="').concat(Link).concat(arItem[i][0]).concat('&c=').concat(FolderId).concat('">');
		sHTML = sHTML.concat(arItem[i][1]).concat('</a></li>');		
		i++;		
	}
	sHTML = sHTML.concat('</ul>');	
	return sHTML;
}

function orderAdwordHome(a, b){
	return (parseInt(b[2]) - parseInt(a[2]));
}

function showAdWordItem(FolderId, Items, iType){
	if(FolderId < 0) {
		FolderId = 0;
	}
	var sLink = '';	
	var arItem = new Array();
	var iMaxItem = 50;
	sLink = '/ListFile/AdWord/' + FolderId + '.xml';	
	AjaxRequest.get(
		{
		'url':sLink
		,'onSuccess':function(req){						
			if(req.responseXML.getElementsByTagName('I').length>0) {				
				var iCount=0;								
		    	for (var i=0;i<req.responseXML.getElementsByTagName('I').length;i++){					
					with(req.responseXML.getElementsByTagName('I').item(i)){
						if(iCount < iMaxItem){
							var sTemp = getNodeValue(getElementsByTagName('I'));
							if (sTemp!=''){
								arItem[iCount] = new Array(6);
								arItem[iCount][0] = getNodeValue(getElementsByTagName('I'));
								arItem[iCount][1] = getNodeValue(getElementsByTagName('T'));																				
								arItem[iCount][2] = getNodeValue(getElementsByTagName('P'));																				
								arItem[iCount][3] = getNodeValue(getElementsByTagName('S'));																				
								arItem[iCount][4] = getNodeValue(getElementsByTagName('D'));																				
								arItem[iCount][5] = getNodeValue(getElementsByTagName('PR'));																				
								iCount++;
							}
						}
		    		}		    		
		    	}
			}
			gmobj("adw_".concat(FolderId)).innerHTML=getAdWordItem(arItem, FolderId, iType, Items);			
		}
		,'onError':function(req){}
		}
	)
}

function getAdWordItem(arItem, FolderId, iType, Items){
	var sHTML = '';
	var Link = '';
	var i=0;
	var maxTop = 8;
	if(FolderId=='13_15'||FolderId=='12_14'){
		maxTop = 10;
	}
	sHTML = sHTML.concat('<ul>');
	var arItemTemp = new Array();
	var flag = false;	
	while(i<arItem.length){
		if(arItem[i][2]==1){
			arItemTemp[i] = new Array(6);
			arItemTemp[i][0] = arItem[i][0];
			arItemTemp[i][1] = arItem[i][1];
			arItemTemp[i][2] = arItem[i][2];
			arItemTemp[i][3] = arItem[i][3];
			arItemTemp[i][4] = arItem[i][4];
			arItemTemp[i][5] = arItem[i][5];
		}
		else{
			break;
		}
		i++;
	}
	i=0;
	if(arItemTemp.length > maxTop){
		flag = true;
	}
	if(iType==0){
		var len = arItemTemp.length;			
		while(arItemTemp.length > maxTop){			
			arItemTemp.splice(Math.round((arItemTemp.length-1)*Math.random()),1);							
		}
		while(i<arItemTemp.length){
			Link = '/User/Rao-vat/Source/View.Asp?ID='.concat(arItemTemp[i][0]).concat('&c=').concat(FolderId)
			sHTML = sHTML.concat('<li><div class="adword-dline"><ul>');
			sHTML = sHTML.concat('<li class="fl" style="width:70%"><a class="AdvLink2" href="').concat(Link).concat('" onClick="return openAdWord(\'').concat(arItemTemp[i][0]).concat('\',\'').concat(arItemTemp[i][2]).concat('\');">');
			sHTML = sHTML.concat(arItemTemp[i][1]).concat('</a></li>');			
			if(iType==0){
				var sDates = arItemTemp[i][4].split(' ');
				sHTML = sHTML.concat('<li class="fl txtr" style="width:10%; line-height:18px"><label class="item-date">').concat(dmy(sDates[0])).concat('</label></li>');
			}
			sHTML = sHTML.concat('<li class="fl txtr" style="width:20%; line-height:18px"><label class="item-date">').concat(arItemTemp[i][5]).concat('</label></li>');
			sHTML = sHTML.concat('</ul></div></li>');
			i++;
		}		
		if(flag==true){
			i = len;
			Items = Items + (i-maxTop);
		}
		while(i<arItem.length && i<Items) {			
			Link = '/User/Rao-vat/Source/View.Asp?ID='.concat(arItem[i][0]).concat('&c=').concat(FolderId)
			sHTML = sHTML.concat('<li><div class="adword-dline"><ul>');
			sHTML = sHTML.concat('<li class="fl" style="width:70%"><a class="BoxLink2" href="').concat(Link).concat('" onClick="return openAdWord(\'').concat(arItem[i][0]).concat('\',\'').concat(arItem[i][2]).concat('\');">');
			sHTML = sHTML.concat(arItem[i][1]).concat('</a></li>');			
			if(iType==0){
				var sDates = arItem[i][4].split(' ');
				sHTML = sHTML.concat('<li class="fl txtr" style="width:10%; line-height:18px"><label class="item-date">').concat(dmy(sDates[0])).concat('</label></li>');
			}	
			sHTML = sHTML.concat('<li class="fl txtr" style="width:20%; line-height:18px"><label class="item-date">').concat(arItem[i][5]).concat('</label></li>');
			sHTML = sHTML.concat('</ul></div></li>');			
					
			i++;		
		}
	}
	else{
		while(i<arItem.length && i<Items) {
			if(arItem[i][2]==1){				
				Link = '/User/Rao-vat/Source/View.Asp?ID='.concat(arItem[i][0]).concat('&c=').concat(FolderId)
				sHTML = sHTML.concat('<li style="padding-bottom:5px;"><a class="AdvLink2" href="').concat(Link).concat('" onClick="return openAdWord(\'').concat(arItem[i][0]).concat('\',\'').concat(arItem[i][2]).concat('\');">');
				sHTML = sHTML.concat(arItem[i][1]).concat('</a>');
				/*if(iType==0){
					var sDates = arItem[i][4].split(' ');
					sHTML = sHTML.concat('<label class="item-date"> - ').concat(dmy(sDates[0])).concat('</label>');
				}*/	
				sHTML = sHTML.concat('</li>');						
			}
			else{
				Link = '/User/Rao-vat/Source/View.Asp?ID='.concat(arItem[i][0]).concat('&c=').concat(FolderId)
				sHTML = sHTML.concat('<li style="padding-bottom:5px;"><a class="BoxLink2" href="').concat(Link).concat('" onClick="return openAdWord(\'').concat(arItem[i][0]).concat('\',\'').concat(arItem[i][2]).concat('\');">');
				sHTML = sHTML.concat(arItem[i][1]).concat('</a>');
				if(iType==0){
					var sDates = arItem[i][4].split(' ');
					sHTML = sHTML.concat('<label class="item-date"> - ').concat(dmy(sDates[0])).concat('</label>');
				}	
				sHTML = sHTML.concat('</li>');	
			}
					
			i++;		
		}
	}	
	sHTML = sHTML.concat('</ul>');	
	return sHTML;
}

function ShowAdWordTitle(FolderId){
	var strTitle = ''
	switch(parseInt(FolderId)){
		case 1: strTitle = 'D&#7883;ch v&#7909; s&#7917;a ch&#7919;a gia d&#7909;ng'; break;
		case 2: strTitle = 'D&#7883;ch v&#7909; v&#259;n ph&#242;ng'; break;
		case 3: strTitle = 'B&#225;n thi&#7871;t b&#7883; v&#259;n ph&#242;ng v&#224; ph&#7909; ki&#7879;n'; break;
		case 4: strTitle = 'Mua thi&#7871;t b&#7883; v&#259;n ph&#242;ng v&#224; ph&#7909; ki&#7879;n'; break;
		case 5: strTitle = 'B&#225;n &#244;t&#244; xe m&#225;y'; break;
		case 6: strTitle = 'Mua &#244;t&#244; xe m&#225;y'; break;
		case 7: strTitle = 'Nh&#7855;n tin'; break;
		case 8: strTitle = 'B&#225;n &#273;i&#7879;n tho&#7841;i di &#273;&#7897;ng'; break;
		case 9: strTitle = 'Mua &#273;i&#7879;n tho&#7841;i di &#273;&#7897;ng'; break;
		case 10: strTitle = 'T&#236;m &#273;&#7889;i t&#225;c'; break;
		case 11: strTitle = 'Linh tinh'; break;
		case 12: strTitle = 'Cho thu&#234; nh&#224;'; break;
		case 13: strTitle = 'B&#225;n nh&#224;'; break;
		case 14: strTitle = 'C&#7847;n thu&#234; nh&#224;'; break;
		case 15: strTitle = 'C&#7847;n mua nh&#224;'; break;
		case 16: strTitle = 'T&#236;m vi&#7879;c l&#224;m'; break;
		case 17: strTitle = 'C&#7847;n tuy&#7875;n'; break;
		case 18: strTitle = 'Cho thu&#234; xe'; break;
		case 19: strTitle = 'V&#259;n h&#243;a ph&#7849;m'; break;
		case 20: strTitle = 'PM & TK Web'; break;
		case 21: strTitle = 'Tuy&#7875;n sinh'; break;
		default: break;
	}
	document.write(strTitle);
}

function ShowWeatherBox(vId){
	var sLink = '';
	var sUrl = 'http://vnexpress.net';
	sLink = sUrl + '/ListFile/Weather/';
	switch (parseInt(vId)){	    	
		case 1: sLink = sLink.concat('Sonla.xml');break;
		case 2: sLink = sLink.concat('Viettri.xml');break;
		case 3: sLink = sLink.concat('Haiphong.xml');break;
		case 4: sLink = sLink.concat('Hanoi.xml');break;
		case 5: sLink = sLink.concat('Vinh.xml');break;
		case 6: sLink = sLink.concat('Danang.xml');break;
		case 7: sLink = sLink.concat('Nhatrang.xml');break;
		case 8: sLink = sLink.concat('Pleicu.xml');break;		
		case 9: sLink = sLink.concat('HCM.xml');break;	
		default: sLink = sLink.concat('Hanoi.xml');break;
	}
	AjaxRequest.get(
		{
			'url':sLink
			,'onSuccess':function(req){
				var vAdImg, vAdImg1, vAdImg2, vAdImg3, vAdImg4, vAdImg5, vWeather;
				vAdImg = req.responseXML.getElementsByTagName('AdImg').item(0).firstChild.nodeValue;
				vAdImg1 = req.responseXML.getElementsByTagName('AdImg1').item(0).firstChild.nodeValue;
				if(req.responseXML.getElementsByTagName('AdImg2').item(0).firstChild != null)
					vAdImg2 = req.responseXML.getElementsByTagName('AdImg2').item(0).firstChild.nodeValue;
				if(req.responseXML.getElementsByTagName('AdImg3').item(0).firstChild != null)
					vAdImg3 = req.responseXML.getElementsByTagName('AdImg3').item(0).firstChild.nodeValue;
				if(req.responseXML.getElementsByTagName('AdImg4').item(0).firstChild != null)
					vAdImg4 = req.responseXML.getElementsByTagName('AdImg4').item(0).firstChild.nodeValue;
				if(req.responseXML.getElementsByTagName('AdImg5').item(0).firstChild != null)
					vAdImg5 = req.responseXML.getElementsByTagName('AdImg5').item(0).firstChild.nodeValue;
				vWeather = req.responseXML.getElementsByTagName('Weather').item(0).firstChild.nodeValue;
				GetWeatherBox(vAdImg, vAdImg1, vAdImg2, vAdImg3, vAdImg4, vAdImg5, vWeather);				
				}
			,'onError':function(req){}
		}
	)
}

function GetWeatherBox(vImg, vImg1, vImg2, vImg3, vImg4, vImg5, vWeather){
	var sHTML = '';
	sHTML = sHTML.concat('<img src="/Images/Weather/').concat(vImg).concat('" class="img-weather" alt="" />&nbsp;');
	sHTML = sHTML.concat('<img src="/Images/Weather/').concat(vImg1).concat('" class="img-weather" alt="" />');
	if(vImg2!=null) sHTML = sHTML.concat('<img src="/Images/Weather/').concat(vImg2).concat('" class="img-weather" alt="" />');
	if(vImg3!=null) sHTML = sHTML.concat('<img src="/Images/Weather/').concat(vImg3).concat('" class="img-weather" alt="" />');
	if(vImg4!=null) sHTML = sHTML.concat('<img src="/Images/Weather/').concat(vImg4).concat('" class="img-weather" alt="" />');
	if(vImg5!=null) sHTML = sHTML.concat('<img src="/Images/Weather/').concat(vImg5).concat('" class="img-weather" alt="" />');
	sHTML = sHTML.concat('<img src="/Images/Weather/c.gif" class="img-weather" alt="" />');
	
	gmobj('img-Do').innerHTML = sHTML;
	gmobj('txt-Weather').innerHTML = vWeather;
}

function ShowGoldPrice(){
	var sHTML = '';
	sHTML = sHTML.concat('<div style="text-align:right;color:#8A0000;font:bold 10px arial;">ĐVT: tr.&#273;/l&#432;&#7907;ng</div>');
	if(vGoldSbjBuy=='{0}' || vGoldSbjSell=='{1}' || vGoldSjcBuy =='{2}' || vGoldSjcSell=='{3}'){
		sHTML = sHTML.concat('<table border="0px" cellpadding="2px" cellspacing="1px" class="tbl-goldprice">');
		sHTML = sHTML.concat('	<tr>');	
		sHTML = sHTML.concat('		<td class="td-weather-title" style="text-align:center;font-size:10px;width:35%;font-weight:bold">D&#7919; li&#7879;u &#273;ang &#273;&#432;&#7907;c c&#7853;p nh&#7853;t</td>');	
		sHTML = sHTML.concat('	</tr>');
		sHTML = sHTML.concat('</table>');
	}
	else{	
		sHTML = sHTML.concat('<table border="0px" cellpadding="2px" cellspacing="1px" class="tbl-goldprice">');
		sHTML = sHTML.concat('	<tr>');
		sHTML = sHTML.concat('		<td class="td-weather-title" style="font-size:10px;width:30%;">Lo&#7841;i</td>');
		sHTML = sHTML.concat('		<td class="td-weather-title" style="text-align:center;font-size:10px;width:35%;">Mua</td>');
		sHTML = sHTML.concat('		<td class="td-weather-title" style="text-align:center;font-size:10px;width:35%;">B&#225;n</td>');
		sHTML = sHTML.concat('	</tr>');
		sHTML = sHTML.concat('	<tr>');
		sHTML = sHTML.concat('		<td class="td-weather-title">SBJ</td>');
		sHTML = sHTML.concat('		<td class="td-weather-data txtr">').concat(vGoldSbjBuy).concat('</td>');
		sHTML = sHTML.concat('		<td class="td-weather-data txtr">').concat(vGoldSbjSell).concat('</td>');
		sHTML = sHTML.concat('	</tr>');
		sHTML = sHTML.concat('	<tr>');
		sHTML = sHTML.concat('		<td class="td-weather-title">SJC</td>');
		sHTML = sHTML.concat('		<td class="td-weather-data txtr">').concat(vGoldSjcBuy).concat('</td>');
		sHTML = sHTML.concat('		<td class="td-weather-data txtr">').concat(vGoldSjcSell).concat('</td>');
		sHTML = sHTML.concat('	</tr>');
		sHTML = sHTML.concat('</table>');	
	}
	gmobj('eGold').innerHTML = sHTML;
}

function ShowForexRate(){
	var sHTML = '';
	sHTML = sHTML.concat('<table border="0px" cellpadding="2px" cellspacing="1px" class="tbl-weather">');
	for(var i=0;i<vForexs.length;i++){
		sHTML = sHTML.concat('	<tr>');
		sHTML = sHTML.concat('		<td class="td-weather-title">').concat(vForexs[i]).concat('</td>');
		sHTML = sHTML.concat('		<td class="td-weather-data txtr">').concat(vCosts[i]).concat('</td>');
		sHTML = sHTML.concat('	</tr>');
	}
	sHTML = sHTML.concat('</table>');
	gmobj('eForex').innerHTML = sHTML;
}

function showlistitem(sTemplate,sFolder,sListItems){		
	var sId, sName, sPath;
	var arItem = new Array();	
	var sLink = '';
	if(DOMESTIC_IP==0) {
		sLink = '/ListFile/Subject/'.concat(Right(Hexa(PAGE_SITE),2)).concat('/sd_').concat(sFolder).concat('.xml');
	}
	else {
		sLink = '/ListFile/Subject/'.concat(Right(Hexa(PAGE_SITE),2)).concat('/so_').concat(sFolder).concat('.xml');
	}
	
	var sHTML;
	var iMaxItem;
	iMaxItem = sListItems;		
	AjaxRequest.get(
		{
	    'url':sLink
	    ,'onSuccess':function(req){			
	    	if (req.responseXML.getElementsByTagName('F').length>0){				
	    		with(req.responseXML.getElementsByTagName('F').item(0)){
					sId = getNodeValue(getElementsByTagName('I'));
					sName = toUpper(getNodeValue(getElementsByTagName('N')));
					sPath = getNodeValue(getElementsByTagName('P'));					
	    		}
	    	}
	    	var iCount=0;
	    	for (var i=0;i<req.responseXML.getElementsByTagName('I').length;i++){
	    		with(req.responseXML.getElementsByTagName('I').item(i)){
	    			if (iCount<iMaxItem){
		    			var sTemp = getNodeValue(getElementsByTagName('I'));
		    			if (sTemp!='' && displayid(sTemp)){
			    			arItem[iCount] = new Array(20);
							arItem[iCount][0] = getNodeValue(getElementsByTagName('I'));
							arItem[iCount][1] = getNodeValue(getElementsByTagName('P')) + '/';
							arItem[iCount][2] = getNodeValue(getElementsByTagName('T'));
							arItem[iCount][3] = getNodeValue(getElementsByTagName('L'));
							arItem[iCount][4] = getNodeValue(getElementsByTagName('TI'));
							arItem[iCount][5] = getNodeValue(getElementsByTagName('TW'));
							arItem[iCount][6] = getNodeValue(getElementsByTagName('TH'));
							arItem[iCount][7] = getNodeValue(getElementsByTagName('SI'));
							arItem[iCount][8] = getNodeValue(getElementsByTagName('SW'));
							arItem[iCount][9] = getNodeValue(getElementsByTagName('SH'));
							arItem[iCount][10] = getNodeValue(getElementsByTagName('LI'));
							arItem[iCount][11] = getNodeValue(getElementsByTagName('LW'));
							arItem[iCount][12] = getNodeValue(getElementsByTagName('LH'));
							arItem[iCount][13] = getNodeValue(getElementsByTagName('HV'));
							arItem[iCount][14] = getNodeValue(getElementsByTagName('HI'));
							arItem[iCount][15] = getNodeValue(getElementsByTagName('HS'));	
							arItem[iCount][16] = getNodeValue(getElementsByTagName('OI'));
							arItem[iCount][17] = getNodeValue(getElementsByTagName('OW'));
							arItem[iCount][18] = getNodeValue(getElementsByTagName('OH'));
							arItem[iCount][19] = getNodeValue(getElementsByTagName('F'));
							iCount++;
						}
					}
	    		}
	    	}	
			sHTML = getlistitem(sId, sName, sPath, arItem, sTemplate);					
			gmobj('ListItem'.concat(sFolder)).innerHTML=sHTML;			
	    }
	    ,'onError':function(req){
			gmobj('ListItem'.concat(sFolder)).innerHTML=req.statusText;			
			}
		}
	)
}

function getlistitem(sId, sName, sPath, arItem, sTemplate) {	
	var sHTML = '';
	var i=0;
	switch (parseInt(sTemplate)) {
		case 1: case 7:			
			while (i<arItem.length) {
				if(i==0){
					sHTML = sHTML.concat('<div class="list-item1-content fl">');
					if(arItem[i][7] != '' && parseInt(sTemplate) == 1){
						sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img class="fl" src="').concat(getimages(arItem[i][0],arItem[i][7])).concat('" alt="" /></a>');
					}
					else if(arItem[i][16] != '' && parseInt(sTemplate) == 7){
						sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img class="fl" src="').concat(getimages(arItem[i][0],arItem[i][16])).concat('" alt="" /></a>');
					}
					if(parseInt(sTemplate) == 1){
						sHTML = sHTML.concat('	<p>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-listitem1-title')).concat(arItem[i][2]).concat('</a></p>');
						sHTML = sHTML.concat('	<p>').concat(arItem[i][3].replace(/class=Lead/ig,'class=Lead2')).concat('</p>');
					}
					else{
						sHTML = sHTML.concat('	<p style="text-align:center">').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-listitem1-title')).concat(arItem[i][2]).concat('</a></p>');
					}
					sHTML = sHTML.concat('</div>');
				}
				else if(i==1) {
					sHTML = sHTML.concat('<div class="list-item1-content fl"><hr /></div>');
					sHTML = sHTML.concat('<div class="list-item1-content fl">');
					sHTML = sHTML.concat('	<ul>');
					sHTML = sHTML.concat('		<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-listitem1-othernews')).concat(arItem[i][2]).concat('</a></li>');
				}
				else if(i!=arItem.length-1){
					sHTML = sHTML.concat('		<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-listitem1-othernews')).concat(arItem[i][2]).concat('</a></li>');
				}
				else {
					sHTML = sHTML.concat('		<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-listitem1-othernews')).concat(arItem[i][2]).concat('</a></li>');
					sHTML = sHTML.concat('	</ul>');
					sHTML = sHTML.concat('</div>');
				}				
				i++;
			}
			sHTML = sHTML.concat('</div>');
			break;
		case 2: case 6:
			sHTML = sHTML.concat('<ul>');
			while (i<arItem.length) {
				sHTML = sHTML.concat('	<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews2')).concat(arItem[i][2]).concat('</a></li>');
				i++;
			}
			sHTML = sHTML.concat('</ul>');
			break;
		case 3: case 4:
			while (i<arItem.length) {
				if(i==0){	
					sHTML = sHTML.concat('<div class="box-middle1 list-item fl">');
					if(arItem[0][7] != '') {
						sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img class="img-listitem3 fl" src="').concat(getimages(arItem[0][0],arItem[0][7])).concat('" alt="" /></a>');	
					}
					else if(arItem[0][10] != '') {
						sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img class="img-listitem3 fl" src="').concat(getimages(arItem[0][0],arItem[0][10])).concat('" alt="" /></a>');	
					}
					sHTML = sHTML.concat('<p>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-title')).concat(arItem[0][2]).concat('</a></p>');
					sHTML = sHTML.concat('<p>').concat(arItem[0][3].replace(/class=Lead/ig,'class=Lead1')).concat('</p>');
					sHTML = sHTML.concat('</div>');
				}
				else if(i==1){
					sHTML = sHTML.concat('<div class="box-middle1 list-item3 fl">');
					sHTML = sHTML.concat('	<ul>');
					sHTML = sHTML.concat('		<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews2')).concat(arItem[i][2]).concat('</a></li>');
				}
				else if(i!=arItem.length-1){
					sHTML = sHTML.concat('		<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews2')).concat(arItem[i][2]).concat('</a></li>');
					
				}
				else{
					sHTML = sHTML.concat('		<li>').concat(BuildLink(arItem[i][19], arItem[i][1], 'link-othernews2')).concat(arItem[i][2]).concat('</a></li>');
					sHTML = sHTML.concat('	</ul>');
					sHTML = sHTML.concat('</div>');					
				}
				i++;
			}
			break;
		case 5:			
			var iCount = 0;
			while (i<arItem.length) {
				if((iCount == 0) && (i < arItem.length -1)) {
					sHTML = sHTML.concat('<div class="box-middle1 list-item5 fl">');
					sHTML = sHTML.concat('	<div class="list-item5-content fl">');
					if(arItem[i][10] != ''){
						sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img src="').concat(getimages(arItem[i][0],arItem[i][10])).concat('" class="fl" alt=""/></a>');
					}
					sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat(arItem[i][2]).concat('</a>');
					sHTML = sHTML.concat('	</div>');
					sHTML = sHTML.concat('	<img class="img-sep-listitem5 fl" src="/Images/Background/sep-listitem5.gif" alt="" />');
					iCount = 1;
				}
				else if((iCount == 0) && (i == arItem.length-1)) {
					sHTML = sHTML.concat('<div class="box-middle1 list-item5 fl">');
					sHTML = sHTML.concat('	<div class="list-item5-content fl">');
					if(arItem[i][10] != ''){
						sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img src="').concat(getimages(arItem[i][0],arItem[i][10])).concat('" class="fl" alt=""/></a>');
					}
					sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat(arItem[i][2]).concat('</a>');
					sHTML = sHTML.concat('	</div>');
					sHTML = sHTML.concat('	<img class="img-sep-listitem5 fl" src="/Images/Background/sep-listitem5.gif" alt="" />');
					sHTML = sHTML.concat('</div>');					
				}
				else if(iCount == 1) {
					sHTML = sHTML.concat('	<div class="list-item5-content fl">');
					if(arItem[i][10] != ''){
						sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat('<img src="').concat(getimages(arItem[i][0],arItem[i][10])).concat('" class="fl" alt=""/></a>');
					}
					sHTML = sHTML.concat(BuildLink(arItem[i][19], arItem[i][1], '')).concat(arItem[i][2]).concat('</a>');
					sHTML = sHTML.concat('	</div>');
					sHTML = sHTML.concat('</div>');
					iCount = 0;
				}
				i++;
			}
			break;
		default: break;
	}
	return sHTML;
}

function showhotitem(sFolder,sListItems) {
	var sId, sName, sPath;
	var arItem = new Array();
	sLink = '';
	if(DOMESTIC_IP==0) {
		sLink = '/ListFile/HotNews/'.concat(Right(Hexa(PAGE_SITE),2)).concat('/sd_').concat(sFolder).concat('.xml');
	}
	else {
		sLink = '/ListFile/HotNews/'.concat(Right(Hexa(PAGE_SITE),2)).concat('/so_').concat(sFolder).concat('.xml');
	}
	
	var sHTML;
	var iMaxItem;
	iMaxItem = sListItems;		
	AjaxRequest.get(
		{
	    'url':sLink
	    ,'onSuccess':function(req){			
	    	if (req.responseXML.getElementsByTagName('F').length>0){				
	    		with(req.responseXML.getElementsByTagName('F').item(0)){
					sId = getNodeValue(getElementsByTagName('I'));
					sName = toUpper(getNodeValue(getElementsByTagName('N')));
					sPath = getNodeValue(getElementsByTagName('P'));					
	    		}
	    	}
	    	var iCount=0;
	    	for (var i=0;i<req.responseXML.getElementsByTagName('I').length;i++){
	    		with(req.responseXML.getElementsByTagName('I').item(i)){
	    			if (iCount<iMaxItem){
		    			var sTemp = getNodeValue(getElementsByTagName('I'));
		    			if (sTemp!='' && displayid(sTemp)){
			    			arItem[iCount] = new Array(20);
							arItem[iCount][0] = getNodeValue(getElementsByTagName('I'));
							arItem[iCount][1] = getNodeValue(getElementsByTagName('P')) + '/';
							arItem[iCount][2] = getNodeValue(getElementsByTagName('T'));
							arItem[iCount][3] = getNodeValue(getElementsByTagName('L'));
							arItem[iCount][4] = getNodeValue(getElementsByTagName('TI'));
							arItem[iCount][5] = getNodeValue(getElementsByTagName('TW'));
							arItem[iCount][6] = getNodeValue(getElementsByTagName('TH'));
							arItem[iCount][7] = getNodeValue(getElementsByTagName('SI'));
							arItem[iCount][8] = getNodeValue(getElementsByTagName('SW'));
							arItem[iCount][9] = getNodeValue(getElementsByTagName('SH'));
							arItem[iCount][10] = getNodeValue(getElementsByTagName('LI'));
							arItem[iCount][11] = getNodeValue(getElementsByTagName('LW'));
							arItem[iCount][12] = getNodeValue(getElementsByTagName('LH'));
							arItem[iCount][13] = getNodeValue(getElementsByTagName('HV'));
							arItem[iCount][14] = getNodeValue(getElementsByTagName('HI'));
							arItem[iCount][15] = getNodeValue(getElementsByTagName('HS'));
							arItem[iCount][16] = getNodeValue(getElementsByTagName('OI'));
							arItem[iCount][17] = getNodeValue(getElementsByTagName('OW'));
							arItem[iCount][18] = getNodeValue(getElementsByTagName('OH'));
							arItem[iCount][19] = getNodeValue(getElementsByTagName('F'));
							iCount++;
						}
					}
	    		}
	    	}	    	
			sHTML = gethotitem(sId, sName, sPath, arItem);
			gmobj('HotItem'+sFolder).innerHTML=sHTML;						
	    }
	    ,'onError':function(req){
			gmobj('HotItem'.concat(sFolder)).innerHTML=req.statusText;			
			}
		}
	)
}

function gethotitem(sId, sName, sPath, arItem) {
	var sHTML = '';		
	sHTML = getlistitem(sId, sName, sPath, arItem, 5);
	return sHTML;
}

function FormatCurrency(num, currencyCode, isReplace, justFormat) {
    if (num == null)
        return "";
    var num = num.toString().replace(/\$|\,/g, '');
    if (isNaN(num))
        num = "0";
    var sign = (num == (num = Math.abs(num)));
    num = Math.floor(num * 100 + 0.50000000001);
    cents = num % 100;
    num = Math.floor(num / 100).toString();
    if (cents < 10)
        cents = "0" + cents;
    for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++) {
        switch (Trim(currencyCode.toLowerCase())) {
            case 'en-us':
                {
                    num = num.substring(0, num.length - (4 * i + 3)) + ',' + num.substring(num.length - (4 * i + 3));
                    break;
                }
            case 'vi-vn':
                {
                    num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
                    break;
                }
        }
    }
    var res = '0';
    switch (Trim(currencyCode.toLowerCase())) {
        case 'en-us':
            {
                if (justFormat != null && justFormat == true) {
                    if (isReplace == false)
                        res = (((sign) ? '' : '-') + num + '.' + cents);
                    else
                        res = (((sign) ? '' : '-') + num);
                }
                else {
                    if (isReplace == false)
                        res = (((sign) ? '' : '-') + '$' + num + '.' + cents);
                    else
                        res = (((sign) ? '' : '-') + '$' + num);
                }
                break;
            }
        case 'vi-vn':
            {
                if (justFormat != null && justFormat == true) {
                    if (isReplace == false)
                        res = (((sign) ? '' : '-') + num + ',' + cents);
                    else
                        res = (((sign) ? '' : '-') + num);
                }
                else {
                    if (isReplace == false)
                        res = (((sign) ? '' : '-') + num + ',' + cents + '<u>d</u>');
                    else
                        res = (((sign) ? '' : '-') + num + '<u>d</u>');
                }
                break;
            }
    }
    return res;
}

function showTableGoldPrice() {    
      AjaxRequest.get(
      {
            "url": "/Service/San-vang/Data/SbjServices.xml"
            , 'onSuccess': function(req) {
                  var strOut = "";
                  var OPENPRICE;
                  var HIGHESTPRICE;
                  var LOWESTPRICE;
                  var MATCHVOL; 
                  var Item = req.responseXML.getElementsByTagName('Ticker').item(0);
                  
                  OPENPRICE = getNodeValue(Item.getElementsByTagName('OPENPRICE'));
                  HIGHESTPRICE = getNodeValue(Item.getElementsByTagName('HIGHESTPRICE'));
                  LOWESTPRICE = getNodeValue(Item.getElementsByTagName('LOWESTPRICE'));
                  MATCHVOL = parseInt(getNodeValue(Item.getElementsByTagName('MATCHVOL'))) * 2;
                  
                  strOut = strOut.concat("<ul class='st-ul'>");
                  strOut = strOut.concat("<li class='st-li-hd hd-top5-bd fl'>");
                  strOut = strOut.concat("<ul class='st-ul'>");                     
                  strOut = strOut.concat("<li class='st-li-hd fl'>");
                  strOut = strOut.concat("<ul class='st-ul'>");
                  strOut = strOut.concat("<li class='hd-sp3 fl'>&nbsp;</li>");
                  strOut = strOut.concat("<li class='hd-top1-gp fl'>");
                  strOut = strOut.concat("<div style='padding:4px;'>");
				  
					strOut = strOut.concat("<table style='border: thin none ;cursor:pointer;' cellspacing='0' cellpadding='0' width='100%' border='0' onclick=\"window.open('http://vnexpress.net/Service/San-vang/');\">");
					strOut = strOut.concat("<tbody>");
					strOut = strOut.concat("<tr height='20'>");
					strOut = strOut.concat("<td class='TopGoldActive' align='center' nowrap='nowrap'>Mã vàng</td>");
					strOut = strOut.concat("<td class='TopGoldActive' align='center' nowrap='nowrap'>Mở cửa</td>");
					strOut = strOut.concat("<td class='TopGoldActive' align='center' nowrap='nowrap'>Thấp nhất</td>");
					strOut = strOut.concat("<td class='TopGoldActive' align='center' nowrap='nowrap'>Cao nhất</td>");
					strOut = strOut.concat("<td class='TopGoldActive' align='center' nowrap='nowrap'>Tổng KLGD</td>");
					strOut = strOut.concat("</tr>");
					strOut = strOut.concat("<tr>");
					strOut = strOut.concat("<td colspan='5' style='padding:2px;'></td>");
					strOut = strOut.concat("</tr>");
					strOut = strOut.concat("<tr>");
					strOut = strOut.concat("<td colspan='5' bgcolor='#c5c5c5' height='1'></td>");
					strOut = strOut.concat("</tr>");   
					strOut = strOut.concat("<tr height='19'>");   
					strOut = strOut.concat("<td class='LbTop' align='center' nowrap='nowrap'><b>SJC</b></td>");
					strOut = strOut.concat("<td class='LbTop' align='center' nowrap='nowrap'>").concat(FormatCurrency(OPENPRICE, 'vi-vn', true, true)).concat("</td>");
					strOut = strOut.concat("<td class='LbTop' align='center' nowrap='nowrap'>").concat(FormatCurrency(LOWESTPRICE, 'vi-vn', true, true)).concat("</td>");  
					strOut = strOut.concat("<td class='LbTop' align='center' nowrap='nowrap'>").concat(FormatCurrency(HIGHESTPRICE, 'vi-vn', true, true)).concat("</td>");
					strOut = strOut.concat("<td class='LbTop' align='center' nowrap='nowrap' style='color:#FF0000;'>").concat(FormatCurrency(MATCHVOL, 'vi-vn', true, true)).concat("</td>");
					strOut = strOut.concat("</tr>");
					strOut = strOut.concat("<tr>");
					strOut = strOut.concat("<td colspan='5' align='right' style='color:#0068ba;font-size:11px;font-style:italic;padding-top:5px;'>(Nguồn:&nbsp;<img alt='Sacombank' src='http://vnexpress.net/Images/logoSb.gif' style='border: 0px none ; vertical-align: middle; width: 80px; height: 9px;'/>)</td>");
					strOut = strOut.concat("</tr>");							  
					strOut = strOut.concat("</tbody>");
					strOut = strOut.concat("</table>");
			
                  strOut = strOut.concat("</div>");
                  strOut = strOut.concat("</li>");
                  strOut = strOut.concat("<li class='hd-sp3 fl'>&nbsp;</li>");
                  strOut = strOut.concat("</ul>");                            
                  strOut = strOut.concat("</li>");
                  strOut = strOut.concat("</ul>");
                  strOut = strOut.concat("</li>");        
                  strOut = strOut.concat("</ul>");

                  gmobj("tblGoldPrice").innerHTML = strOut;
            }
      , 'onError': function(req) { return ""; }
      });
}

// var ViMuaWidget = {
    // init: function(vPosition, vFolder) {
        // AjaxRequest.get(
        // {
            // "url": "/ListFile/Vimua/" + vPosition + "_" + vFolder + ".xml"
            // , 'onSuccess': function(req) {
				// var ItemWidth 	= "";
                // var ItemHeight 	= "";
				// var ItemSpan 	= "";
                // var ItemType 	= "";
                // var ItemName 	= "";
                // var ItemLink 	= "";
                // var ItemImage 	= "";
                // var Description = "";
                // var VimuaPrice 	= "";
                // var MarketPrice = "";
                // var strOut 		= "";
                // var vStyleBottom = "";
                // var k = 0;
				// var vcWidth = 0;
				// var vdWidth = 25;
                // var vWidth = 0;				
                // k = req.responseXML.getElementsByTagName('item').length - 1;				
                // if (vPosition == "Bottom") {
                    // strOut += "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\">";
                    // strOut += "<tr>";
                // }				
                // for (var i = 0; i < req.responseXML.getElementsByTagName('item').length && i < 4 && vcWidth < 100; i++) {										
                    // with (req.responseXML.getElementsByTagName('item').item(i)) {
						// ItemWidth 	= getNodeValue(getElementsByTagName('ItemWidth')); 
                        // ItemHeight 	= getNodeValue(getElementsByTagName('ItemHeight'));
						// ItemSpan 	= getNodeValue(getElementsByTagName('ItemSpan'));
                        // ItemType 	= getNodeValue(getElementsByTagName('ItemType'));
                        // ItemName 	= getNodeValue(getElementsByTagName('ItemName'));
                        // ItemLink 	= getNodeValue(getElementsByTagName('ItemLink'));
                        // ItemImage 	= getNodeValue(getElementsByTagName('ItemImage'));
                        // Description = getNodeValue(getElementsByTagName('Description'));
                        // VimuaPrice 	= getNodeValue(getElementsByTagName('VimuaPrice'));
                        // MarketPrice = getNodeValue(getElementsByTagName('MarketPrice'));						
						// if (ItemSpan == "" || ItemSpan == "0") {
                            // ItemSpan = "1";
                        // }						
                       
                        // if (vPosition == "Right") {
                            // if (i == k) {
                                // vStyleBottom = "";
                            // } else {
                                // vStyleBottom = "border-bottom:solid 1px #c9d5e5;";
                            // }

							// if (/\.(swf)$/.test(ItemImage)) {
								// strOut += "<div style=\"overflow:hidden; cursor:pointer; padding-left:4px;" + vStyleBottom + "\">";
							// }
							// else{								
								// strOut += "<div style=\"overflow:hidden; cursor:pointer; padding-left:4px;" + vStyleBottom + "\" onclick=\"window.open('" + ItemLink + "',target='_blank')\">";
							// }
                                                        
                            // strOut += "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\">";
                            // strOut += "     <tr>";
                            // if (ItemType == "0") {								
								// strOut += "         <td style=\"width:85px;height:58px;\">" + ShowVimuaImage(1, "clsImgProductRight-vimua", ItemImage, ItemName, ItemWidth, ItemHeight) + "</td>";								
								// strOut += "         <td style=\"padding-right:4px;\"><div style=\"float:left; height:15px;overflow:hidden;margin-right:1px;\"><label class=\"Desc-vimua\">" + ItemName + "</label></div><br />";
								// strOut += "             <span class=\"Desc-vimua\">Giá bán:</span><br />"
								// strOut += "             <span class=\"Price-vimua\">" + VimuaPrice + "</span><br />"
								// strOut += "             <span class=\"Desc-vimua\">Giá thị trường:</span><br />"
								// strOut += "             <span class=\"Price-vimua Price-vimua-market\">" + MarketPrice + "</span><br />"
                            // } else {
                                // if (Description == "") {                                    
                                    // strOut += "     <td colspan=\"2\"><div style=\"width:172px;overflow:hidden;\">" + ShowVimuaImage(1, "clsImgArticleRight-vimua", ItemImage, ItemName, ItemWidth, ItemHeight) + "</div></td>";
                                // } else {
									// strOut += "     <td style=\"width:85px;height:58px;\">" + ShowVimuaImage(1, "clsImgProductRight-vimua", ItemImage, ItemName, ItemWidth, ItemHeight) + "</td>";
                                    // strOut += "     <td><div style=\"float:left; height:15px;overflow:hidden;margin-right:1px;\"><label class=\"Desc-vimua\">" + ItemName + "</label></div>" + Description + "</td>";
                                // }
                            // }
                            // strOut += "     </tr>";
                            // strOut += "</table>";                            
                            // strOut += "</div>";

                        // } else if (vPosition == "Bottom") {
                            // if (i == k) {
                                // vStyleRight = "margin:2px 0px;";
                            // } else {
                                // vStyleRight = "margin:2px 0px; border-right:solid 1px #c9d5e5;";
                            // }							
                            // vWidth = vdWidth * parseInt(ItemSpan);
                            // vcWidth = vcWidth + vWidth;							

                            // strOut += "<td width='" + vWidth + "%'>";
							// if (/\.(swf)$/.test(ItemImage)) {
								// strOut += "<div style=\"overflow:hidden; cursor:pointer; " + vStyleRight + "\">";
							// }
							// else {
								// strOut += "<div style=\"overflow:hidden; cursor:pointer; " + vStyleRight + "\" onclick=\"window.open('" + ItemLink + "',target='_blank')\">";
							// }
                            // strOut += "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" width=\"100%\">";
                            // strOut += "     <tr>";
                            // if (ItemType == "0") {                               
                                // strOut += "         <td>" + ShowVimuaImage(0, "clsImgProduct-vimua", ItemImage, ItemName, ItemWidth, ItemHeight) + "</td>";                                
                                // strOut += "         <td><div style=\"float:left; height:15px;overflow:hidden\"><label class=\"Desc-vimua\">" + ItemName + "</label></div><br />"
                                // strOut += "             <span class=\"Desc-vimua\">Giá bán:</span><br />"
                                // strOut += "             <span class=\"Price-vimua\">" + VimuaPrice + "</span><br />"
                                // strOut += "             <span class=\"Desc-vimua\">Giá thị trường:</span><br />"
                                // strOut += "             <span class=\"Price-vimua Price-vimua-market\">" + MarketPrice + "</span><br />"
                                // strOut += "         </td>";
                            // } else {
                                // if (Description == "") {                                    
                                    // strOut += "     <td colspan=\"2\"><div style=\"height:86px;overflow:hidden;\">" + ShowVimuaImage(0, "clsImgArticle-vimua", ItemImage, ItemName, ItemWidth, ItemHeight) + "</div></td>";
                                // } else {
									// strOut += "     <td>" + ShowVimuaImage(0, "clsImgProduct-vimua", ItemImage, ItemName, ItemWidth, ItemHeight) + "</td>";
                                    // strOut += "     <td><label class=\"Desc-vimua\">" + Description + "</label></td>";
                                // }
                            // }
                            // strOut += "     </tr>";
                            // strOut += "</table>";							
                            // strOut += "</div>";
                            // strOut += "</td>";
                        // }
                    // }
                // }

                // if (vPosition == "Bottom") {
                    // strOut += "</tr>";
                    // strOut += "</table>";
                // }

                // if (vPosition == "Right") {
                    // gmobj("vimua-content-right").innerHTML = strOut;
                // } else if (vPosition == "Bottom") {
                    // gmobj("vimua-content-bottom").innerHTML = strOut;
                // }
            // }
            // , 'onError': function(req) { return ""; }
        // }
        // );
    // }
// };

// function ShowVimuaImage(position, className, source, imageName, ItemWidth, ItemHeight) {
    // var strReturn = '';
	// if(ItemWidth==""){
		// ItemWidth = "100%";
	// }
	// if(ItemHeight==""){
		// ItemHeight = "100%";
	// }
    // switch(position){
        // case 0:

            // if (/\.(swf)$/.test(source)) {
                // strReturn = strReturn.concat('<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0 " alt="').concat(imageName).concat('" WIDTH="').concat(ItemWidth).concat('" HEIGHT="').concat(ItemHeight).concat('">');
                // strReturn = strReturn.concat('<PARAM NAME="movie" VALUE="').concat(source).concat('">');
                // strReturn = strReturn.concat('<PARAM NAME="AllowScriptAccess" VALUE="always">');
                // strReturn = strReturn.concat('<PARAM NAME="quality" VALUE="high">');
                // strReturn = strReturn.concat('<PARAM NAME="bgcolor" VALUE="#FFFFFF">');
                // strReturn = strReturn.concat('<PARAM NAME="wmode" VALUE="transparent">');
				// strReturn = strReturn.concat('<PARAM NAME="base" VALUE="').concat(source.substring(0, source.lastIndexOf("/"))).concat('">');
                // strReturn = strReturn.concat('<EMBED src="').concat(source).concat('" quality="high" bgcolor="#FFFFFF"').concat('" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer" WIDTH="').concat(ItemWidth).concat('" HEIGHT="').concat(ItemHeight).concat('" wmode="transparent" AllowScriptAccess="always" alt="').concat(imageName).concat('" base="').concat(source.substring(0, source.lastIndexOf("/"))).concat('">');
                // strReturn = strReturn.concat('</OBJECT>');
            // }
            // else {
                // strReturn = "<img src=\"" + source + "\" class=\"" + className + "\" alt=\"" + imageName + "\" />";
            
            // }
        // case 1:
            // if (/\.(swf)$/.test(source)) {
                // strReturn = strReturn.concat('<OBJECT classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=7,0,0,0 " alt="').concat(imageName).concat('" WIDTH="').concat(ItemWidth).concat('" HEIGHT="').concat(ItemHeight).concat('">');
                // strReturn = strReturn.concat('<PARAM NAME="movie" VALUE="').concat(source).concat('">');
                // strReturn = strReturn.concat('<PARAM NAME="AllowScriptAccess" VALUE="always">');
                // strReturn = strReturn.concat('<PARAM NAME="quality" VALUE="high">');
                // strReturn = strReturn.concat('<PARAM NAME="bgcolor" VALUE="#FFFFFF">');
                // strReturn = strReturn.concat('<PARAM NAME="wmode" VALUE="transparent">');
				// strReturn = strReturn.concat('<PARAM NAME="base" VALUE="').concat(source.substring(0, source.lastIndexOf("/"))).concat('">');
                // strReturn = strReturn.concat('<EMBED src="').concat(source).concat('" quality="high" bgcolor="#FFFFFF"').concat('" ALIGN="" TYPE="application/x-shockwave-flash" PLUGINSPAGE="http://www.macromedia.com/go/getflashplayer" WIDTH="').concat(ItemWidth).concat('" HEIGHT="').concat(ItemHeight).concat('" wmode="transparent" AllowScriptAccess="always" alt="').concat(imageName).concat('" base="').concat(source.substring(0, source.lastIndexOf("/"))).concat('">');
                // strReturn = strReturn.concat('</OBJECT>');
            // }
            // else {
                // strReturn = "<img src=\"" + source + "\" class=\"" + className + "\" alt=\"" + imageName + "\" />"; 
            // }
                      
    // }  
    // return strReturn;
// }

function BuildLink(folder,path, classname){
	var strReturn = '<a href="';
	if(folder >= 600 && folder <= 612){
		strReturn = strReturn + 'http://ebank.vnexpress.net' + path + '" target="_blank" ';
	}
	else{		
		strReturn = strReturn + path + '" ';
	}
	if(classname==''){
		strReturn = strReturn + '>';
	}
	else{
		strReturn = strReturn + ' class="' + classname + '">';
	}
	return strReturn;
}

/*** 11/01/2010 HaiVTH Add some new functions ***/
function showAdWordItemNew(folderID, itemsLength, parentId){
	itemsLength = 25;
	// Tin dac biet tung chuyen muc
	getAdWordItemTopOneNew(folderID, parentId);
	
	var sLink = '';	
	var arItem = new Array();
	sLink = '/ListFile/AdWord/' + folderID + '.xml';	
	var iCount = 0;
	
	AjaxRequest.get({
		'url':sLink,
		'onSuccess':function(req){
			var arrElements = req.responseXML.getElementsByTagName('I');
			var itemCount = arrElements.length;
			if(itemCount>0){
				for (var i = 0; i < itemCount; i++){
					with(arrElements.item(i)){
						var sTemp = getNodeValue(getElementsByTagName('I'));
						if (sTemp!=''){
							arItem[iCount] = new Array(10);
							arItem[iCount][0] = getNodeValue(getElementsByTagName('I'));
							arItem[iCount][1] = getNodeValue(getElementsByTagName('T'));																				
							arItem[iCount][2] = getNodeValue(getElementsByTagName('P'));																				
							arItem[iCount][3] = getNodeValue(getElementsByTagName('S'));																				
							arItem[iCount][4] = getNodeValue(getElementsByTagName('D'));																				
							arItem[iCount][5] = getNodeValue(getElementsByTagName('PR'));
							arItem[iCount][6] = getNodeValue(getElementsByTagName('IMG'));
							arItem[iCount][7] = getNodeValue(getElementsByTagName('DES'));
							arItem[iCount][8] = getNodeValue(getElementsByTagName('CN'));
							arItem[iCount][9] = getNodeValue(getElementsByTagName('CE'));
							iCount++;
						}
					}		    		
				}
			}			
			gmobj('list_' + parentId).innerHTML=getAdWordItemNew(arItem, folderID, itemsLength, parentId);			
		},
		'onError':function(req){gmobj('list_' + parentId).innerHTML = '';}
	});
}

function checkTopByCate(parentId){	
	var topObj = gmobj('top_' + parentId);
	var lenTop = topObj.getElementsByTagName('div').length;
	var listObj = gmobj('list_' + parentId);
	if (lenTop <= 0){
		topObj.style.height = '0px';
		listObj.style.height = '518px';
		return false;		
	}
	else{
		//topObj.style.height = '142px';
		topObj.style.height = '105px';
		//listObj.style.height = '370px';
		listObj.style.height = '413px';
		//listObj.style.marginTop = '5px';
		return true;
	}
}

function getAdWordItemNew(arItem, folderID, itemsLength, parentId){	
	var sHTML = '';
	var Link = '';
	var i=0;
	switch(folderID){
		case "12":
		case "13":
		case "14":
		case "15": 
		case "12_13_14_15": maxTop = 12; break;
		default: maxTop = 10; break;
	}
	
	var arItemTemp = new Array();
	var arItemTemp0 = new Array();	
	var flag = false;
	
	var tmpi = 0;
	var tmpi0 = 0;
	while(i<arItem.length){
		if(arItem[i][2]==1){
			arItemTemp[tmpi] = new Array(10);
			arItemTemp[tmpi][0] = arItem[i][0];
			arItemTemp[tmpi][1] = arItem[i][1];
			arItemTemp[tmpi][2] = arItem[i][2];
			arItemTemp[tmpi][3] = arItem[i][3];
			arItemTemp[tmpi][4] = arItem[i][4];
			arItemTemp[tmpi][5] = arItem[i][5];
			arItemTemp[tmpi][6] = arItem[i][6];
			arItemTemp[tmpi][7] = arItem[i][7];
			arItemTemp[tmpi][8] = arItem[i][8];
			arItemTemp[tmpi][9] = arItem[i][9];			
			tmpi++;
		}
		else{
			arItemTemp0[tmpi0] = new Array(10);
			arItemTemp0[tmpi0][0] = arItem[i][0];
			arItemTemp0[tmpi0][1] = arItem[i][1];
			arItemTemp0[tmpi0][2] = arItem[i][2];
			arItemTemp0[tmpi0][3] = arItem[i][3];
			arItemTemp0[tmpi0][4] = arItem[i][4];
			arItemTemp0[tmpi0][5] = arItem[i][5];
			arItemTemp0[tmpi0][6] = arItem[i][6];
			arItemTemp0[tmpi0][7] = arItem[i][7];
			arItemTemp0[tmpi0][8] = arItem[i][8];
			arItemTemp0[tmpi0][9] = arItem[i][9];			
			tmpi0++;
		}
		i++;
	}
	
	var tmplen = arItemTemp.length;		
	while(arItemTemp.length > maxTop){			
		arItemTemp.splice(Math.round((arItemTemp.length-1)*Math.random()),1);							
	}
	
	i=0;
	var lastDate = '';
	arItemTemp = reOrderArrayByDate(arItemTemp);
	while(i<arItemTemp.length){
		Link = '/User/Rao-vat/Source/View.Asp?ID='.concat(arItemTemp[i][0]).concat('&c=').concat(folderID);		
		var sDates = arItemTemp[i][4].split('/');
		sHTML = sHTML.concat('	<li class="out">');
		sHTML = sHTML.concat('		<ul class="ulLine">');
		sHTML = sHTML.concat('			<li class="liTitle">');
		sHTML = sHTML.concat('				<a class="AdvLinkRV" href="').concat(Link).concat('">').concat(arItemTemp[i][1]).concat('</a>');
		sHTML = sHTML.concat('			</li>');
		sHTML = sHTML.concat('			<li class="liDate">').concat(sDates[1]).concat('/').concat(sDates[0]).concat('</li>');
		sHTML = sHTML.concat('			<li class="liArea">').concat(arItemTemp[i][5]).concat('</li>');
		sHTML = sHTML.concat('		</ul>');
		sHTML = sHTML.concat('	</li>');		
		lastDate = escape(arItem[i][4]);
		i++;
	}
	
	// Cac tin khac (tin khong tra tien)
	var icount = 0;	
	i = tmplen;
	itemsLength = itemsLength - (i >= maxTop ? maxTop : i);		
	i = 0;
	arItemTemp0 = reOrderArrayByDate(arItemTemp0);
	while(i<arItemTemp0.length && i<itemsLength){
		Link = '/User/Rao-vat/Source/View.Asp?ID='.concat(arItemTemp0[i][0]).concat('&c=').concat(folderID);
		var sDates = arItemTemp0[i][4].split('/');		
		sHTML = sHTML.concat('	<li class="out">');
		sHTML = sHTML.concat('		<ul class="ulLine">');
		sHTML = sHTML.concat('			<li class="liTitle">');
		sHTML = sHTML.concat('				<a class="BoxLinkRV" href="').concat(Link).concat('">').concat(arItemTemp0[i][1]).concat('</a>');
		sHTML = sHTML.concat('			</li>');
		sHTML = sHTML.concat('			<li class="liDate">').concat(sDates[1]).concat('/').concat(sDates[0]).concat('</li>');
		sHTML = sHTML.concat('			<li class="liArea">').concat(arItemTemp0[i][5]).concat('</li>');
		sHTML = sHTML.concat('		</ul>');
		sHTML = sHTML.concat('	</li>');
		if (i < 20) lastDate = escape(arItemTemp0[i][4]);
		i++;		
		icount++;		
	}
	
	var tmpf = folderID;
	switch(folderID){
		case '12_13_14_15': tmpf = '13'; break;
		case '5_6_18_22': tmpf = '5'; break;
		case '23_24_25_26': tmpf = '23'; break;
		case '20_27_28_29': tmpf = '28'; break;
		case '31_32_33': tmpf = '32'; break;
		case '8_9_34': tmpf = '8'; break;
		case '1_35_36': tmpf = '1'; break;
		case '16_17_21': tmpf = '17'; break;
		case '2_3_4': tmpf = '3'; break;
	}
	gmobj('other_' + parentId).getElementsByTagName('a')[0].setAttribute('href', '/User/Rao-vat/Source/List.Asp?c=' + tmpf + '&d=' + lastDate);
	
	return sHTML;
}

function getAdWordItemTopOneNew(folderId, parentId){
	switch(folderId){
		case '12_13_14_15': folderId = '13'; break;
		case '5_6_18_22': folderId = '5'; break;
		case '23_24_25_26': folderId = '23'; break;
		case '20_27_28_29': folderId = '28'; break;
		case '31_32_33': folderId = '32'; break;
		case '8_9_34': folderId = '8'; break;
		case '1_35_36': folderId = '1'; break;
		case '16_17_21': folderId = '17'; break;
		case '2_3_4': folderId = '3'; break;
	}
	
	AjaxRequest.get({
		'url':'/ListFile/AdWord/Top_' + folderId + '.xml',
		'onSuccess':function(req){
			var arItem = new Array();
			var iCount = 0;
			var arrElements = req.responseXML.getElementsByTagName('I');
			if(arrElements && arrElements.length>0){
				for (var i = 0; i < arrElements.length; i++){
					with(arrElements.item(i)){
						var sTemp = getNodeValue(getElementsByTagName('I'));
						if (sTemp!=''){
							arItem[iCount] = new Array(10);
							arItem[iCount][0] = getNodeValue(getElementsByTagName('I'));
							arItem[iCount][1] = getNodeValue(getElementsByTagName('T'));																				
							arItem[iCount][2] = getNodeValue(getElementsByTagName('P'));																				
							arItem[iCount][3] = getNodeValue(getElementsByTagName('S'));																				
							arItem[iCount][4] = getNodeValue(getElementsByTagName('D'));																				
							arItem[iCount][5] = getNodeValue(getElementsByTagName('PR'));
							arItem[iCount][6] = getNodeValue(getElementsByTagName('IMG'));
							arItem[iCount][7] = getNodeValue(getElementsByTagName('DES'));
							arItem[iCount][8] = getNodeValue(getElementsByTagName('CN'));
							arItem[iCount][9] = getNodeValue(getElementsByTagName('CE'));
							iCount++;
						}
					}		    		
				}
			}
			
			var sHTML = '';
			for (var i=0; i<arItem.length; i++){
				var lnk = '/User/Rao-vat/Source/View.Asp?ID=' + arItem[i][0] + '&c=' + folderId;
				if (i == 0)
					sHTML = sHTML.concat('<div id="' + folderId + '_' + i + '" style="width: 480px; display: block; position: absolute; z-index:' + i + '">');
				else
					sHTML = sHTML.concat('<div id="' + folderId + '_' + i + '" style="width: 480px; display: none; position: absolute; z-index:' + i + '">');
				
				var imgP = '';
				if (arItem[i][6] != '')
					imgP = 'http://srv.vnexpress.net' + arItem[i][6] + '.thumb134x0.jpg';
					//imgP += '.thumb134x0.jpg';
				else{
					switch(folderId){
						case '13':
						case '15':
						case '12':imgP = '/images/AdWord/New/Home/nhadat.gif';break;
						case '5':
						case '6':
						case '18':imgP = '/images/AdWord/New/Home/moto.gif';break;
						case '3':
						case '4':
						case '2':imgP = '/images/AdWord/New/Home/tbvp.gif';break;
						case '8':
						case '9':
						case '8_9':imgP = '/images/AdWord/New/Home/dtdd.gif';break;
						case '11':imgP = '/images/AdWord/New/Home/other.gif';break;
						case '17':
						case '16':
						case '21':imgP = '/images/AdWord/New/Home/tstd.gif';break;
						case '1':imgP = '/images/AdWord/New/Home/dvtn.gif';break;
					}
				}
				sHTML = sHTML.concat('<div class="aBDS_top">');
				sHTML = sHTML.concat('	<a href="').concat(lnk).concat('">');
				sHTML = sHTML.concat('		<img src="').concat(imgP).concat('" style="width: 134px;"/>');					
				sHTML = sHTML.concat('	</a>');
				sHTML = sHTML.concat('</div>');				
				sHTML = sHTML.concat('<div class="aBDS_topr">');
				//sHTML = sHTML.concat('<div style="border: 1px solid #cccccc; background: transparent url(' + imgP + ') no-repeat scroll top center; height: 130px; width: 134px; float: left; margin-right: 12px; cursor: pointer;" onclick="location.href=' + "'" + lnk + "'" + '"></div>');				
				sHTML = sHTML.concat('	<div class="BDS_ct">');
				sHTML = sHTML.concat('		<p class="pBDS_title"><a style="color: #181818" onclick="blur();" href="' + lnk + '">').concat(arItem[i][1]).concat('</a></p>');
				sHTML = sHTML.concat('		<p class="pspecial_des">').concat(arItem[i][7]).concat('		<a class="BDS_link" href="').concat(lnk).concat('">Xem chi ti&#7871;t</a>').concat('</p>');
				/*sHTML = sHTML.concat('		<p class="postBy">&#272;&#259;ng b&#7903;i: ').concat('<a>').concat(arItem[i][8]).concat('</a>');
				if (arItem[i][4] != '')
					sHTML = sHTML.concat('		<p class="areaSale">').concat(arItem[i][5]).concat(' - ').concat(showDate(arItem[i][4])).concat('</p>');
				else
					sHTML = sHTML.concat('		<p class="areaSale">').concat(arItem[i][5]).concat('</p>');*/
				sHTML = sHTML.concat('	</div>');
				
				/*sHTML = sHTML.concat('	<div class="BDS_view">');
				sHTML = sHTML.concat('		<a class="BDS_link" href="').concat(lnk).concat('">Xem chi ti&#7871;t</a>');
				sHTML = sHTML.concat('		<a class="BDS_link" href="').concat('/User/Rao-vat/Source/List.asp?c=').concat(folderId).concat('">C&#225;c tin kh&#225;c</a>');
				sHTML = sHTML.concat('	</div>');*/
				sHTML = sHTML.concat('</div>');
				sHTML = sHTML.concat('</div>');
			}			
			gmobj('top_' + parentId).innerHTML = sHTML;
			displayAdWordTopByCate(parentId, folderId, 0);
			checkTopByCate(parentId);
		},
		'onError':function(req){gmobj('top_' + parentId).innerHTML = ''; checkTopByCate(parentId);}
	});
}

function displayAdWordTopByCate(parentId, folderId, curIndex){
	len = jQuery('#top_' + parentId + ' > div').length;	
	if (len > 1){
		jQuery('#top_' + parentId + ' > div').each(function(){
			if (jQuery(this).css('display') == 'block')
				jQuery(this).stop().fadeOut('slow');
		});
	}
	if (jQuery('#' + folderId + '_' + curIndex).css('display') == 'none');
		jQuery('#' + folderId + '_' + curIndex).stop().fadeIn("slow");	
	
	curIndex = (curIndex + 1 >= len) ? 0 : curIndex + 1;
	if (len > 1) var t = setTimeout('displayAdWordTopByCate("' + parentId + '",' + folderId + ',' + curIndex + ')', 20000);
			
	/*var logId = curIndex;
	if (getCookie('logAdWordTop' + folderId) != '')
		logId = parseInt(getCookie('logAdWordTop' + folderId)) + 1;
	if (curIndex == logId) curIndex = curIndex + 1;
	if (curIndex > len - 1) curIndex = 0;
	setCookie('logAdWordTop' + folderId, '', (new Date().addDays(1)).toGMTString(), curIndex);*/	
	
	//jQuery('#top_nd > div').length
	/*var len = 0;
	if (!jQuery.browser.msie && !jQuery.browser.mozilla){		
		len = gmobj('top_' + parentId).getElementsByTagName('div').length/3;		
		if (len > 1){
			var arr = gmobj('top_' + parentId).getElementsByTagName('div');
			var arrTmp = new Array();
			var id = '';
			for(var i=0; i<arr.length; i++){
				id = arr[i].getAttribute('id');
				if (typeof(id) != 'undefined' && id != 'null' && id != '') arrTmp[arrTmp.length] = arr[i];
			}
			for(var i=0; i<arrTmp.length; i++){
				if (arrTmp[i].style.display == 'block') arrTmp[i].style.display = 'none';
			}
		}
		if (gmobj(folderId + '_' + curIndex).style.display == 'none')
			gmobj(folderId + '_' + curIndex).style.display = 'block';
	}
	else{
		len = jQuery('#top_' + parentId).children().length;	
		if (len > 1){
			jQuery('#top_' + parentId + ' > div').each(function(){
				if (jQuery(this).css('display') == 'block')
					jQuery(this).stop().fadeOut('slow');
			});
		}
		if (jQuery('#' + folderId + '_' + curIndex).css('display') == 'none');
			jQuery('#' + folderId + '_' + curIndex).stop().fadeIn("slow");	
	}
		
	curIndex = (curIndex + 1 >= len) ? 0 : curIndex + 1;
	if (len > 1) var t = setTimeout('displayAdWordTopByCate("' + parentId + '",' + folderId + ',' + curIndex + ')', 20000);	*/
}

function showAdWordItemRightFromFile(folderId, itemLength) {
	var sHTML = '';
	var sHead = '';
	if(folderId < 0) {
		folderId = 0;
	}
	
	var sLink = '';	
	var arItem = new Array();
	sLink = '/ListFile/AdWord/' + folderId + '.xml';	
	var iCount = 0;
	AjaxRequest.get({
		'url':sLink
		,'onSuccess':function(req){
			var arrElements = req.responseXML.getElementsByTagName('I');
			var itemCount = arrElements.length;
			switch (folderId) {
				case 13: sHead = 'B&#225;n nh&#224;'; break;
				case 15: sHead = 'Mua nh&#224;'; break;
				case 12: sHead = 'Cho thu&#234; nh&#224;'; break;
				case 5: sHead = 'B&#225;n xe'; break;
				case 6: sHead = 'Mua xe'; break;
				case 1: sHead = 'Cho thu&#234; xe'; break;
				case 3: sHead = 'B&#225;n thi&#7871;t b&#7883; v&#259;n ph&#242;ng'; break;
				case 4: sHead = 'Mua thi&#7871;t b&#7883; v&#259;n ph&#242;ng'; break;
				case 2: sHead = 'D&#7883;ch v&#7909; v&#259;n ph&#242;ng'; break;
				case 2: sHead = 'D&#7883;ch v&#7909; v&#259;n ph&#242;ng'; break;
			}
			sHTML = sHTML.concat('<div class="rightBoxes">');
			sHTML = sHTML.concat('	<div class="right_head">');
			sHTML = sHTML.concat('		<div class="right_act">');
			sHTML = sHTML.concat('			<div class="right_actL"></div>');
			sHTML = sHTML.concat('			<div class="right_actM">').concat(sHead).concat('</div>');
			sHTML = sHTML.concat('			<div class="right_actR"></div>');
			sHTML = sHTML.concat('		</div>');
			sHTML = sHTML.concat('		<div class="right_view">');
			sHTML = sHTML.concat('			<a href="').concat('/User/Rao-vat/Source/List.asp?c=').concat(folderId).concat('">Xem ti&#7871;p</a>');
			sHTML = sHTML.concat('		</div>');
			sHTML = sHTML.concat('	</div>');
			sHTML = sHTML.concat('	<div class="right_rv">');
			sHTML = sHTML.concat('		<div class="right_rv_2">');
			sHTML = sHTML.concat('			<div class="right_rv_3">');
			sHTML = sHTML.concat('				<ul class="ulRV">');
			var lnk = '';
			var iCount = 0;
			if(itemCount>0) {
				for (var i = 0; i < itemCount && iCount < 10; i++){
					with(arrElements.item(i)){
						lnk = '/User/Rao-vat/Source/View.Asp?ID='.concat(getNodeValue(getElementsByTagName('I'))).concat('&c=').concat(folderId);
						var sTemp = getNodeValue(getElementsByTagName('I'));
						if (sTemp!=''){											
							sHTML = sHTML.concat('					<li>');
							if (getNodeValue(getElementsByTagName('P')) == 1) {
								sHTML = sHTML.concat('						<a class="AdvLinkRV" href="').concat(lnk).concat('" onClick="return openAdWord(\'').concat(getNodeValue(getElementsByTagName('I'))).concat('\',\'').concat(folderId).concat('\');">').concat(getNodeValue(getElementsByTagName('T'))).concat('</a>');
							}
							else {
								sHTML = sHTML.concat('						<a class="BoxLink" href="').concat(lnk).concat('">').concat(getNodeValue(getElementsByTagName('T'))).concat('</a>');
							}
							sHTML = sHTML.concat('					</li>');
							iCount++;
						}
					}		    		
				}
			}
			sHTML = sHTML.concat('				</ul>');
			sHTML = sHTML.concat('			</div>');
			sHTML = sHTML.concat('		</div>');
			sHTML = sHTML.concat('	</div>');
			sHTML = sHTML.concat('</div>');
			
			try {
				gmobj('rightBoxRV_'.concat(folderId)).innerHTML = sHTML;
			}
			catch (Error) {
				return;
			}
		},
		'onError':function(req){}
	})
}

function showDate(sDate) {
	var strDate = '';
	
	var d = new Date(sDate);	
	
	try {
		if (!isNaN(d)) {
		if (d.getHours() < 10 )
			strDate = strDate + "0" + d.getHours() + ":" 
		else strDate = strDate + d.getHours() + ":" ;
		if (d.getMinutes() < 10)
			strDate = strDate + "0" + d.getMinutes() 
		else strDate = strDate + d.getMinutes();
		
		strDate = strDate + " | ";	
		
		var dtmp = new Date();
		if (dtmp.getDay() == d.getDay())
			strDate = strDate + "H&#244;m nay";
		else {
			switch (d.getDay()) {
				case 0:
					strDate = strDate + "Ch&#7911; nh&#7853;t";
					break;
				case 1:
					strDate = strDate + "Th&#7913; hai";
					break;
				case 2:
					strDate = strDate + "Th&#7913; ba";
					break;
				case 3:
					strDate = strDate + "Th&#7913; t&#432;";
					break;
				case 4:
					strDate = strDate + "Th&#7913; n&#259;m";
					break;
				case 5:
					strDate = strDate + "Th&#7913; s&#225;u";
					break;
				case 6:
					strDate = strDate + "Th&#7913; b&#7843;y";
					break;
			}
		}}
	}
	catch (Error) { return '';}
	return strDate;
}

function activeLink(strLinkIds, parentId){
	var arrLinks = strLinkIds.split(',');
	var tmp = strLinkIds.split(',');
	var obj;
	for (var i=0; i < arrLinks.length; i++){
		obj = gmobj('lnk' + arrLinks[i]);
		if (typeof(obj) != 'undefined' && obj != null){
			//if (i==0) obj.setAttribute('class', 'childAct');
			if (i==0) obj.className = 'childAct';
			else if (obj.className == 'childAct') obj.className = 'childNor';
			//else if (obj.getAttribute('class') == 'childAct') obj.className = 'childNor';
		}
	}
}

function deactiveLink(strLinkIds, parentId){
	var arrLinks = strLinkIds.split(',');
	var tmp = strLinkIds.split(',');
	var obj;
	for (var i=0; i < arrLinks.length; i++){
		obj = gmobj('lnk' + arrLinks[i]);
		if (typeof(obj) != 'undefined' && obj != null && (obj.getAttribute('class') == 'childAct')){
			obj.className = 'childNor';
		}
	}
}

// Linh tinh
function showAdWordItemNew2(foderId, itemNumber, parentId) {
	if(foderId < 0) {
		foderId = 0;
	}
	var sLink = '';	
	var arItem = new Array();
	sLink = '/ListFile/AdWord/' + foderId + '.xml';	
	var iCount = 0;
	
	AjaxRequest.get({
		'url':sLink,
		'onSuccess':function(req){
			var arrElements = req.responseXML.getElementsByTagName('I');
			var itemCount = arrElements.length;
			if(itemCount>0) {
				for (var i = 0; i < itemCount; i++){
					with(arrElements.item(i)){
						var sTemp = getNodeValue(getElementsByTagName('I'));
						if (sTemp!=''){
							arItem[iCount] = new Array(6);
							arItem[iCount][0] = getNodeValue(getElementsByTagName('I'));
							arItem[iCount][1] = getNodeValue(getElementsByTagName('T'));																				
							arItem[iCount][2] = getNodeValue(getElementsByTagName('P'));																				
							arItem[iCount][3] = getNodeValue(getElementsByTagName('S'));																				
							arItem[iCount][4] = getNodeValue(getElementsByTagName('D'));																				
							arItem[iCount][5] = getNodeValue(getElementsByTagName('PR'));																				
							iCount++;
						}
					}		    		
				}
			}
			gmobj(parentId).innerHTML=getAdWordItemNew2(arItem, foderId, itemNumber);
		},
		'onError':function(req){}
	})
}

function getAdWordItemNew2(arItem, foderId, itemsLength){
	var sHTML = '';
	var Link = '';
	var i=0;
	var maxTop = 6;
	
	var arItemTemp = new Array();
	var flag = false;
	
	while(i<arItem.length) {
		if(arItem[i][2]==1){
			arItemTemp[i] = new Array(6);
			arItemTemp[i][0] = arItem[i][0];
			arItemTemp[i][1] = arItem[i][1];
			arItemTemp[i][2] = arItem[i][2];
			arItemTemp[i][3] = arItem[i][3];
			arItemTemp[i][4] = arItem[i][4];
			arItemTemp[i][5] = arItem[i][5];
		}
		else{break;}
		i++;
	}
	
	i=0;
	while(arItemTemp.length > maxTop){			
		arItemTemp.splice(Math.round((arItemTemp.length-1)*Math.random()),1);							
	}
	
	i = arItemTemp.length;
	itemsLength = itemsLength - (i >= maxTop ? maxTop : i);
	
	var iCount = 0;
	while (iCount < itemsLength && i < arItem.length) {
		var at = new Array(6);
		at[0] = arItem[i][0];
		at[1] = arItem[i][1];
		at[2] = arItem[i][2];
		at[3] = arItem[i][3];
		at[4] = arItem[i][4];
		at[5] = arItem[i][5];
		arItemTemp.push(at);
		i++;iCount++;
	}
	
	i = 0;
	while(i<arItemTemp.length){
		Link = '/User/Rao-vat/Source/View.Asp?ID='.concat(arItemTemp[i][0]).concat('&c=').concat(foderId);
		if (i % 3 == 0) sHTML = sHTML.concat('<div style="width:483px; height:130px; overflow:hidden;">');
		sHTML = sHTML.concat('	<div class="LT_area" align="center">');
		sHTML = sHTML.concat('		<a href="').concat(Link).concat('" class="aLT_img">');
		sHTML = sHTML.concat('			<img src="" alt="&#7842;nh s&#7843;n ph&#7849;m" />');
		sHTML = sHTML.concat('		</a>');
		sHTML = sHTML.concat('		<p class="pLT_price">').concat(arItemTemp[i][1]).concat('</p>');
		sHTML = sHTML.concat('	</div>');
		if ((i+1) % 3 == 0) sHTML = sHTML.concat('</div>');
		i++;
	}
	
	return sHTML;
}

var arrAdWord = new Array();
function ShowAdWordTopStoryFromFile(divTSId) {
	var sLink = '';	
	var arItem = new Array();
	sLink = '/ListFile/AdWord/Top_0.xml';	
	var iCount = 0;
	
	AjaxRequest.get({
		'url':sLink,
		'onSuccess':function(req){
			var arrElements = req.responseXML.getElementsByTagName('I');
			var itemCount = arrElements.length;
			if(itemCount>0) {
				for (var i = 0; i < itemCount; i++){
					with(arrElements.item(i)){
						var sTemp = getNodeValue(getElementsByTagName('I'));
						if (sTemp!=''){
							arItem[iCount] = new Array(11);
							arItem[iCount][0] = getNodeValue(getElementsByTagName('I'));
							arItem[iCount][1] = getNodeValue(getElementsByTagName('T'));																				
							arItem[iCount][2] = getNodeValue(getElementsByTagName('P'));																				
							arItem[iCount][3] = getNodeValue(getElementsByTagName('S'));																				
							arItem[iCount][4] = getNodeValue(getElementsByTagName('D'));																				
							arItem[iCount][5] = getNodeValue(getElementsByTagName('PR'));
							arItem[iCount][6] = getNodeValue(getElementsByTagName('IMG'));
							arItem[iCount][7] = getNodeValue(getElementsByTagName('DES'));
							arItem[iCount][8] = getNodeValue(getElementsByTagName('CN'));
							arItem[iCount][9] = getNodeValue(getElementsByTagName('CE'));
							arItem[iCount][10] = getNodeValue(getElementsByTagName('CAT'));
							iCount++;
						}
					}		    		
				}
			}
			arrAdWord = arItem;
			getAdWordItemTopStory(divTSId);
			displayAdWordTop(0);
		},
		'onError':function(req){}
	});
}

var adWordT;
function getAdWordItemTopStory(divTSId){
	var sHTML = '';
	var link = '';
	var folderTitle = '';
	var imgSrc = '';
	
	for(var i=0; i<arrAdWord.length; i++){
		switch (arrAdWord[i][10]){
			case "5":
			case "6":
			case "18": 	folderTitle = "&#212; t&#244; xe m&#225;y"; imgSrc = '/images/AdWord/New/Home/moto.gif'; break;
			case "12":
			case "13":
			case "14":
			case "15": 	folderTitle = "Nh&#224; &#273;&#7845;t"; imgSrc = '/images/AdWord/New/Home/nhadat.gif' ;break;
			case "2":
			case "3":
			case "4": 	folderTitle = "Thi&#7871;t b&#7883; v&#259;n ph&#242;ng"; imgSrc = '/images/AdWord/New/Home/tbvp.gif'; break; 
			case "16":
			case "17":
			case "21": 	folderTitle = "Tuy&#7875;n sinh tuy&#7875;n d&#7909;ng"; imgSrc = '/images/AdWord/New/Home/tstd.gif'; break; 
			case "1": 	folderTitle = "D&#7883;ch v&#7909; t&#7841;i nh&#224;"; imgSrc = '/images/AdWord/New/Home/dvtn.gif'; break; 
			case "8":
			case "9": 	folderTitle = "&#272;i&#7879;n tho&#7841;i di &#273;&#7897;ng"; imgSrc = '/images/AdWord/New/Home/dtdd.gif'; break; 
			case "10": 	folderTitle = "T&#236;m &#273;&#7889;i t&#225;c"; break; 
			case "7": 	folderTitle = "Nh&#7855;n tin"; break; 
			case "19": 	folderTitle = "V&#259;n h&#243;a ph&#7849;m"; break; 
			case "20": 	folderTitle = "PM & TK Web"; break; 
			case "11": 	folderTitle = "Linh tinh"; imgSrc = '/images/AdWord/New/Home/other.gif'; break; 
		}
		link = '/User/Rao-vat/Source/View.Asp?ID='.concat(arrAdWord[i][0]).concat('&c=').concat(arrAdWord[i][10]);
		if (i==0) sHTML = sHTML.concat('<div style="position: absolute; z-index:' + i + ';" id="adts_' + i + '" class="adts">');
		else sHTML = sHTML.concat('<div style="position: absolute; z-index:' + i + '; display: none;" id="adts_' + i + '" class="adts">');
		sHTML = sHTML.concat('<div class="hotSale_head">');
		sHTML = sHTML.concat('	<a class="aHotSale" onfocus="this.blur();" href="').concat('/User/Rao-vat/Source/List.asp?c=').concat(arrAdWord[i][10]).concat('">').concat(folderTitle).concat('</a>');
		sHTML = sHTML.concat('	<div class="hotPost">');
		if (arrAdWord[i][9] != '')
			sHTML = sHTML.concat('		&#272;&#259;ng b&#7903;i: <a href="ymsgr:sendIM?').concat(arrAdWord[i][9]).concat('">').concat(arrAdWord[i][8]).concat('</a>');
		else
			sHTML = sHTML.concat('		&#272;&#259;ng b&#7903;i: <a href="').concat('">').concat(arrAdWord[i][8]).concat('</a>');
		sHTML = sHTML.concat('	</div>');
		sHTML = sHTML.concat('</div>');
		sHTML = sHTML.concat('<div class="hotSaleCT">');
		sHTML = sHTML.concat('	<div class="hotSale_left">');
		sHTML = sHTML.concat('		<a href="').concat(link).concat('">');
		if (arrAdWord[i][6] != "")
			sHTML = sHTML.concat('			<img class="hotSaleImg" src="http://srv.vnexpress.net').concat(arrAdWord[i][6]).concat('" alt=""/>');
		else
			sHTML = sHTML.concat('			<img class="hotSaleImg" src="' + imgSrc + '" alt=""/>');
		sHTML = sHTML.concat('		</a>');
		sHTML = sHTML.concat('	</div>');
		sHTML = sHTML.concat('	<div class="hotSale_right">');
		sHTML = sHTML.concat('		<p class="hotSaleTitle"><a href="').concat(link).concat('">').concat(arrAdWord[i][1]).concat('</a></p>');
		sHTML = sHTML.concat('		<p class="pleadRV">').concat(arrAdWord[i][7]).concat('</p>');
		sHTML = sHTML.concat('		<p class="areaSale">');
		sHTML = sHTML.concat(				arrAdWord[i][5]);
		sHTML = sHTML.concat('		</p>');
		sHTML = sHTML.concat('		<p class="areaSale_2">');
		sHTML = sHTML.concat(				showDate(arrAdWord[i][4]));
		sHTML = sHTML.concat('		</p>');
		sHTML = sHTML.concat('	</div>');
		sHTML = sHTML.concat('</div>');
		sHTML = sHTML.concat('</div>');
	}
	sHTML += '<div style="float: right; position: absolute; z-index: 8; display: block; margin-top: 195px; width: 525px; text-align: right;" id="nextprevimg" class="nextprevimg">';
	sHTML += '	<a id="lnkprev" onclick="preTop();" style="cursor:pointer; cursor:hand;"><img id="imgprev" src="/Images/AdWord/New/Home/prea.gif"/></a>&nbsp;<a id="lnknext" onclick="nextTop();" style="cursor:pointer; cursor:hand;"><img id="imgnext" src="/Images/AdWord/New/Home/nexta.gif"/></a>';
	sHTML += '</div>';
	gmobj(divTSId).innerHTML = sHTML;
}

var topIndex = 0;
var toptimeout;
function displayAdWordTop(curIndex){
	/*if (getCookie('logAdWordTop' + folderId) != '')
		curItemIndex = parseInt(getCookie('logAdWordTop' + folderId) != '') + 1;
	if (curItemIndex > arItem.length - 1 || curItemIndex < 0) curItemIndex = 0;
	setCookie('logAdWordTop' + folderId, '', (new Date().addDays(1)).toGMTString(), curItemIndex);*/
	
	topIndex = curIndex;
	var len = jQuery('div.adts').length;
	if (len > 1){
		var prevIndex = (curIndex > 0) ? curIndex - 1: len - 1;
		if (jQuery('#adts_' + prevIndex).css('display') == 'block') jQuery('#adts_' + prevIndex).fadeOut("slow");
		if (jQuery('#adts_' + curIndex).css('display') == 'none') jQuery('#adts_' + curIndex).fadeIn("slow");
		
		curIndex = (curIndex + 1 >= len) ? 0 : curIndex + 1;
		jQuery('#lnkprev').onclick = function(){preTop();}
		jQuery('#lnknext').onclick = function(){nextTop();}
		toptimeout = setTimeout('displayAdWordTop(' + curIndex + ')', 20000);
	}
}

function nextTop(){
	var len = jQuery('div.adts').length;
	if (len > 1){
		if(toptimeout) clearTimeout(toptimeout);	
		jQuery('#adts_' + topIndex).fadeOut("slow");
		topIndex = (topIndex == len - 1) ? 0 : topIndex + 1;	
		jQuery('#adts_' + topIndex).fadeIn("slow");
		toptimeout = setTimeout('displayAdWordTop(' + (topIndex == len - 1 ? 0 : topIndex + 1) + ')', 20000);
	}
}

function preTop(){
	var len = jQuery('div.adts').length;
	if (len > 1){
		if(toptimeout) clearTimeout(toptimeout);	
		jQuery('#adts_' + topIndex).fadeOut("slow");
		topIndex = (topIndex == 0) ? len - 1 : topIndex - 1;	
		jQuery('#adts_' + topIndex).fadeIn("slow");
		toptimeout = setTimeout('displayAdWordTop(' + (topIndex == len - 1 ? 0 : topIndex + 1) + ')', 20000);
	}
}

function sortArrDate(a, b){
	return (new Date(b[4]).getTime() - new Date(a[4]).getTime());
}
function reOrderArrayByDate(arrDate){
	return arrDate.sort(sortArrDate);
}