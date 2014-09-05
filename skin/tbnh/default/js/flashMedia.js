function showVideo(VideoId) {
	var sLink = '';	
	var sList = '';
	var iMaxItem = 4;	
	sLink = '/ListFile/Video/tv' + PAGE_SITE + '.xml';
	AjaxRequest.get(
		{
		'url':sLink
		,'onSuccess':function(req){			
			sList = sList.concat('<ul>');			
			var iCount=0;			
			if(VideoId == 0) {				
				for (var i=0;i<req.responseXML.getElementsByTagName('I').length;i++) {					
					if(req.responseXML.getElementsByTagName('I')[i].getElementsByTagName('I').length > 0) {						
						with(req.responseXML.getElementsByTagName('I').item(i)) {
							if(iCount < iMaxItem) {
								if(i==0) {
									showVideoObject(getNodeValue(getElementsByTagName('I')),getNodeValue(getElementsByTagName('T')),getNodeValue(getElementsByTagName('P')),getNodeValue(getElementsByTagName('IP')));
								}
								else {
									sList = sList.concat('<li><a href="javascript:showVideo(');
									sList = sList.concat(getNodeValue(getElementsByTagName('I')));
									sList = sList.concat(');" class="link-othernews2">');
									sList = sList.concat(getNodeValue(getElementsByTagName('T')));
									sList = sList.concat('</a></li>');
								}
								iCount++;
							}
							else {
								break;
							}
						}
					}
				}
			}
			else {
				for (var i=0;i<req.responseXML.getElementsByTagName('I').length;i++) {
					if(req.responseXML.getElementsByTagName('I')[i].getElementsByTagName('I').length > 0) {	
						with(req.responseXML.getElementsByTagName('I').item(i)) {
							if(iCount < iMaxItem) {
								if(parseInt(getNodeValue(getElementsByTagName('I'))) == VideoId) {
									showVideoObject(getNodeValue(getElementsByTagName('I')),getNodeValue(getElementsByTagName('T')),getNodeValue(getElementsByTagName('P')),getNodeValue(getElementsByTagName('IP')));
								}
								else {
									sList = sList.concat('<li><a href="javascript:showVideo(');
									sList = sList.concat(getNodeValue(getElementsByTagName('I')));
									sList = sList.concat(');" class="link-othernews2">');
									sList = sList.concat(getNodeValue(getElementsByTagName('T')));
									sList = sList.concat('</a></li>');
								}
								iCount++;
							}	
							else {
								break;
							}
						}
					}
				}
			}
			sList = sList.concat('</ul>');			
			gmobj('MediaList').innerHTML = sList;				
		}
		,'onError':function(req){
			gmobj("divVideo").innerHTML=req.statusText;
			}
		}
	)
}

function showVideoObject(VideoId, title,path,imagepath) {
	var rndNum; var sURL;
	if (VideoId >= 15930) {
		rndNum = Math.floor(Math.random() * 4);
		if (rndNum == 0) {
			sURL = "210.245.86.130";
		}else if (rndNum == 1) {
			sURL = "210.245.86.162";
		}else if (rndNum == 2) {
			sURL = "210.245.86.165";
		}else{
			sURL = "210.245.86.202";
		}
	} else {
		sURL = "210.245.86.203";
	}

	gmobj('video-title').innerHTML 	= title;					
	var so = new SWFObject('/Library/Common/Player/mediaplayer.swf','MediaPlayer','280','240','8');
	so.addParam('allowscriptaccess','always');
	so.addParam('allowfullscreen','true');
	so.addParam('wmode','transparent');
	so.addVariable('width','278');
	so.addVariable('height','238');	
	so.addVariable('file','http://'+ sURL +'/MediaStore/Video/' + path);		
	if(imagepath=='' || imagepath=='NULL'){
		so.addVariable('image','/Images/video-vne.jpg');
	}
	else{				
		so.addVariable('image','http://'+ sURL +'/MediaStore/' + imagepath);
	}
	so.write('mediaspace');
}