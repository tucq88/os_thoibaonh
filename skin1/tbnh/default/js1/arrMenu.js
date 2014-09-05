var menu_fid = new Array(
	1,		// Trang nhat
	18,		// Xa hoi
	2,		// The gioi
	3,		// Kinh doanh
	51,		// Van hoa
	9,		// The thao
	//121,	// Euro 2008
	47,		// Phap luat
	110,	// Doi song
	83,		// Khoa hoc
	89,		// Vi tinh
	38,		// O to - Xe may
	109,	// Ban doc viet
	127,	// Tam su
	9998,	// Rao vat
	105,	// Cuoi
	400,	// Anh
	401, 	// Video
	//155,	// Bau cu My
	118,	// Cuoc song do day
	146,	// Anh
	145,	// Vu an	
	130,	// Nguoi Viet 5 chau
	113,	// Phan tich
	108,	// Tai lieu
	600,	// Ebank
	98,		// Chung khoan
	6,		// Bat dong san
	8,		// Doanh nhan
	97,		// Quoc te	
	5,		// Mua sam
	99,		// Doanh nghiep viet	
	162,	// Danh ba
	//123,	// Hoi nhap
	//119,	// Seagames
	10,		// Bong da
	11,		// Tennis
	14,		// Chan dung
	156,	// Anh - Video
	19,		// Giao duc	
	144,	// Nhip dieu tre
	32,		// Du lich
	//30,		// Loi song	
	21,		// Du hoc	
	131,	// Tuyen sinh
	171,	// Cong dan toan cau
	143,	// Tu van
	100,	// Hinh su
	152,	// Ky su
	50,		// Tu van	
	154,	// Hoa hau
	64,		// Nghe sy
	57,		// Am nhac
	60,		// Thoi trang	
	65,		// Dien anh
	75,		// My thuat	
	10010,	// Van hoc
	157,	// Moi truong
	135,	// Thien nhien
	158,	// Anh
	134,	// Cong nghe moi
	//136,	// Tam ly
	//87,		// Chuyen do day
	91,		// San pham moi
	93,		// Kinh nghiem
	94,		// Giai tri
	137,	// Hoi dap
	96,		// Hacker & Virus
	117,	// Tieu pham
	153,	// Video
	124,	// The gioi
	125,	// Van hoa
	126,	// The thao
	139,	// Kinh doanh
	140,	// Xa hoi
	174,	// Phap luat
	132,	// Doi song	
	169,	// Khoa hoc	
	26,		// Gia dinh
	78,		// Suc khoe
	35,		// Am thuc
	120,	// Gioi tinh
	101,	// Lam dep	
	151,	// Cua so Blog
	170,	// Thuoc-Thuc pham
	173,	// Benh duong ruot
	106,	// Tu van gia dinh
	148,	// Tu van nuoi day tre
	159,	// Nha dep
	160,	// Tu van
	161,	// Du an
	164,	// Kien truc
	165,	// Vat lieu
	166,	// Moi gioi
	167		// Linh vuc khac
);

var menu_pid = new Array(
	0,
	0,
	0,
	0,
	0,
	0,
	//0,
	0,
	0,
	0,
	0,
	0,
	0,
	0,
	0,
	0,
	1,		// Trang nhat
	1,
	//2,		// The gioi
	2,
	2,
	2,
	2,
	2,
	2,
	3,		// Kinh doanh
	3,
	3,
	3,
	3,
	3,
	3,
	3,
	//3,
	//9,		// The thao	
	9,
	9,
	9,
	9,
	18,		// Xa hoi
	18,
	18,
	//18,
	18,
	18,
	18,
	38,		// O to - Xe may
	47,		// Phap luat
	47,		
	47,
	51,		// Van hoa
	51,		
	51,
	51,
	51,
	51,
	51,
	83,		// Khoa hoc
	83,
	83,
	83,
	//83,
	//83,
	89,		// Vi tinh
	89,
	89,
	89,
	89,
	105,	// Cuoi
	105,
	109,	// Ban doc viet
	109,
	109,
	109,
	109,
	109,
	109,
	109,
	110,	// Doi song
	110,
	110,
	110,
	110,
	110,
	110,
	110,
	110,
	110,
	6,		// Bat dong san
	6,
	6,
	162,	// Danh ba
	162,
	162,
	162
);

var menu_name = new Array(
	'Trang nh&#7845;t',										// Trang nhat
	'X&#227; h&#7897;i',									// Xa hoi
	'Th&#7871; gi&#7899;i',									// The gioi
	'Kinh doanh',											// Kinh doanh
	'V&#259;n h&#243;a',									// Van hoa
	'Th&#7875; thao',										// The thao
	//'Euro 2008',												// Euro 2008
	'Ph&#225;p lu&#7853;t',									// Phap luat
	'&#272;&#7901;i s&#7889;ng',							// Doi song
	'Khoa h&#7885;c',										// Khoa hoc
	'Vi t&#237;nh',											// Vi tinh
	'&#212;t&#244; - Xe m&#225;y',							// O to - Xe may
	'B&#7841;n &#273;&#7885;c vi&#7871;t',					// Ban doc viet
	'T&#226;m s&#7921;',									// Tam su
	'Rao v&#7863;t',										// Rao vat
	'C&#432;&#7901;i',										// Cuoi
	'&#7842;nh',											// Anh
	'Video',												// Video
	//'B&#7847;u c&#7917; M&#7929;',								// Bau cu My
	'Cu&#7897;c s&#7889;ng &#273;&#243; &#273;&#226;y',		// Cuoc song do day
	'&#7842;nh',											// Anh
	'V&#7909; &#225;n',										// Vu an
	'Ng&#432;&#7901;i Vi&#7879;t 5 ch&#226;u',				// Nguoi Viet 5 chau
	'Ph&#226;n t&#237;ch',									// Phan tich
	'T&#432; li&#7879;u',									// Tai lieu
	'Ebank',												// Ebank
	'Ch&#7913;ng kho&#225;n',								// Chung khoan
	'B&#7845;t &#273;&#7897;ng s&#7843;n',					// Bat dong san
	'Doanh nh&#226;n',										// Doanh nhan	
	'Qu&#7889;c t&#7871;',									// Quoc te	
	'Mua s&#7855;m',										// Mua sam
	'Doanh nghi&#7879;p vi&#7871;t',						// Doanh nghiep viet	
	'Danh b&#7841;',										// Danh ba
	//'H&#7897;i nh&#7853;p',										// Hoi nhap		
	//'SEA Games',												// Seagames
	'B&#243;ng &#273;&#225;',								// Bong da
	'Tennis',												// Tennis
	'Ch&#226;n dung',										// Chan dung
	'&#7842;nh - Video',									// Anh - Video
	'Gi&#225;o d&#7909;c',									// Giao duc
	'Nh&#7883;p &#273;i&#7879;u tr&#7867;',					// Nhip dieu tre	
	'Du l&#7883;ch',										// Du lich
	//'L&#7889;i s&#7889;ng',									// Loi song
	'Du h&#7885;c',											// Du hoc	
	'Tuy&#7875;n sinh',										// Tuyen sinh
	'C&#244;ng d&#226;n to&#224;n c&#7847;u',				// Cong dan toan cau
	'T&#432; v&#7845;n',									// Tu van
	'H&#236;nh s&#7921;',									// Hinh su
	'K&#253; s&#7921;',										// Ky su
	'T&#432; v&#7845;n',									// Tu van		
	'Hoa h&#7853;u',										// Hoa hau
	'Ngh&#7879; s&#7929;',									// Nghe sy
	'&#194;m nh&#7841;c',									// Am nhac
	'Th&#7901;i trang',										// Thoi trang	
	'&#272;i&#7879;n &#7843;nh',							// Dien anh
	'M&#7929; thu&#7853;t',									// My thuat	
	'V&#259;n h&#7885;c',									// Van hoc	
	'M&#244;i tr&#432;&#7901;ng',							// Moi truong
	'Thi&#234;n nhi&#234;n',								// Thien nhien
	'&#7842;nh',											// Anh
	'C&#244;ng ngh&#7879; m&#7899;i',						// Cong nghe moi
	//'T&#226;m l&#253;',											// Tam ly
	//'Chuy&#7879;n &#273;&#243; &#273;&#226;y',						// Chuyen do day
	'S&#7843;n ph&#7849;m m&#7899;i',						// San pham moi
	'Kinh nghi&#7879;m',									// Kinh nghiem
	'Gi&#7843;i tr&#237;',									// Giai tri
	'H&#7887;i &#273;&#225;p',								// Hoi dap
	'Hacker & Virus',										// Hacker & Virus
	'Ti&#7875;u ph&#7849;m',								// Tieu pham
	'Video',												// Video
	'Th&#7871; gi&#7899;i',									// The gioi
	'V&#259;n ho&#225;',									// Van hoa
	'Th&#7875; thao',										// The thao
	'Kinh doanh',											// Kinh doanh
	'X&#227; h&#7897;i',									// Xa hoi
	'Ph&#225;p lu&#7853;t',									// Phap luat
	'&#272;&#7901;i s&#7889;ng',							// Doi song
	'Khoa h&#7885;c',										// Khoa hoc	
	'Gia &#273;&#236;nh',									// Gia dinh	
	'S&#7913;c kh&#7887;e',									// Suc khoe
	'&#7848;m th&#7921;c',									// Am thuc
	'Gi&#7899;i t&#237;nh',									// Gioi tinh
	'L&#224;m &#273;&#7865;p',								// Lam dep	
	'C&#7917;a s&#7893; Blog',								// Cua so Blog
	'Thu&#7889;c - Th&#7921;c ph&#7849;m',					// Thuoc-Thuc pham
	'B&#7879;nh &#273;&#432;&#7901;ng ru&#7897;t',			// Benh duong ruot
	'T&#432; v&#7845;n gia &#273;&#236;nh',					// Tu van gia dinh
	'T&#432; v&#7845;n nu&#244;i d&#7841;y tr&#7867;',		// Tu van nuoi day tre
	'Nh&#224; &#273;&#7865;p',								// Nha dep
	'T&#432; v&#7845;n',									// Tu van
	'D&#7921; &#225;n',										// Du an
	'Ki&#7871;n tr&#250;c',									// Kien truc
	'V&#7853;t li&#7879;u',									// Vat lieu
	'M&#7889;i gi&#7899;i',									// Moi gioi
	'L&#297;nh v&#7921;c kh&#225;c'							// Linh vuc khac
);

var menu_uname = new Array(
	'TRANG NH&#7844;T',										// Trang nhat
	'X&#195; H&#7896;I',									// Xa hoi
	'TH&#7870; GI&#7898;I',									// The gioi
	'KINH DOANH',											// Kinh doanh
	'V&#258;N H&#211;A',									// Van hoa
	'TH&#7874; THAO',										// The thao
	//'EURO 2008',												// Euro 2008
	'PH&#193;P LU&#7852;T',									// Phap luat
	'&#272;&#7900;I S&#7888;NG',							// Doi song
	'KHOA H&#7884;C',										// Khoa hoc
	'VI T&#205;NH',											// Vi tinh
	'&#212;T&#212; - XE M&#193;Y',							// O to - Xe may
	'B&#7840;N &#272;&#7884;C VI&#7870;T',					// Ban doc viet
	'T&#194;M S&#7920;',									// Tam su
	'RAO V&#7862;T',										// Rao vat
	'C&#431;&#7900;I',										// Cuoi
	'&#7842;NH',											// Anh
	'VIDEO',												// Video
	//'B&#7846;U C&#7916; M&#7928;',								// Bau cu My
	'CU&#7896;C S&#7888;NG &#272;&#211; &#272;&#194;Y',		// Cuoc song do day
	'&#7842;NH',											// Anh
	'V&#7908; &#193;N',										// Vu an	
	'NG&#431;&#7900;I VI&#7878;T 5 CH&#194;U',				// Nguoi Viet 5 Chau
	'PH&#194;N T&#205;CH',									// Phan tich
	'T&#431; LI&#7878;U',									// Tai lieu
	'EBANK',												// Ebank
	'CH&#7912;NG KHO&#193;N',								// Chung khoan
	'B&#7844;T &#272;&#7896;NG S&#7842;N',					// Bat dong san
	'DOANH NH&#194;N',										// Doanh nhan
	'QU&#7888;C T&#7870;',									// Quoc te	
	'MUA S&#7854;M',										// Mua sam
	'DOANH NGHI&#7878;P VI&#7870;T',						// Doanh nghiep Viet	
	'DANH B&#7840;',										// Danh ba
	//'H&#7896;I NH&#7852;P',										// Hoi nhap		
	//'SEA GAMES',											// Seagames
	'B&#211;NG &#272;&#193;',								// Bon da
	'TENNIS',												// Tennis
	'CH&#194;N DUNG',										// Chan dung
	'&#7842;NH - VIDEO',									// Anh - Video
	'GI&#193;O D&#7908;C',									// Giao duc
	'NH&#7882;P &#272;I&#7878;U TR&#7866;',					// Nhip dieu tre	
	'DU L&#7882;CH',										// Du lich
	//'L&#7888;I S&#7888;NG',									// Loi song
	'DU H&#7884;C',											// Du hoc	
	'TUY&#7874;N SINH',										// Tuyen sinh
	'C&#212;NG D&#194;N TO&#192;N C&#7846;U',				// Cong dan toan cau
	'T&#431; V&#7844;N',									// Tu van
	'H&#204;NH S&#7920;',									// Hinh su
	'K&#221; S&#7920;',										// Ky su
	'T&#431; V&#7844;N',									// Tu van		
	'HOA H&#7852;U',										// Hoa hau
	'NGH&#7878; S&#7928;',									// Nghe sy
	'&#194;M NH&#7840;C',									// Am nhac
	'TH&#7900;I TRANG',										// Thoi trang	
	'&#272;I&#7878;N &#7842;NH',							// Dien anh
	'M&#7928; THU&#7852;T',									// My thuat	
	'V&#258;N H&#7884;C',									// Van hoc	
	'M&#212;I TR&#431;&#7900;NG',							// Moi truong
	'THI&#202;N NHI&#202;N',								// Thien nhien
	'&#7842;NH',											// Anh
	'C&#212;NG NGH&#7878; M&#7898;I',						// Cong nghe	
	//'T&#194;M L&#221;',											// Tam ly
	//'CHUY&#7878;N &#272;&#211; &#272;&#194;Y',						// Chuyen do day
	'S&#7842;N PH&#7848;M M&#7898;I',						// San pham moi
	'KINH NGHI&#7878;M',									// Kinh nghiem
	'GI&#7842;I TR&#205;',									// Giai tri
	'H&#7886;I &#272;&#193;P',								// Hoi dap
	'HACKER &amp; VIRUS',									// Hacker & Virus
	'TI&#7874;U PH&#7848;M',								// Tieu pham
	'VIDEO',												// Video
	'TH&#7870; GI&#7898;I',									// The gioi
	'V&#258;N HO&#193;',									// Van hoa
	'TH&#7874; THAO',										// The thao
	'KINH DOANH',											// Kinh doanh
	'X&#195; H&#7896;I',									// Xa hoi
	'PH&#193;P LU&#7852;T',									// Phap luat
	'&#272;&#7900;I S&#7888;NG',							// Doi song
	'KHOA H&#7884;C',										// Khoa hoc	
	'GIA &#272;&#204;NH',									// Gia dinh	
	'S&#7912;C KH&#7886;E',									// Suc khoe
	'&#7848;M TH&#7920;C',									// Am thuc
	'GI&#7898;I T&#205;NH',									// Gioi tinh
	'L&#192;M &#272;&#7864;P',								// Lam dep
	'C&#7916;A S&#7892; BLOG',								// Cua so Blog
	'THU&#7888;C - TH&#7920;C PH&#7848;M > QU&#7842;NG C&#193;O',	// Thuoc - Thuc pham
	'B&#7878;NH &#272;&#431;&#7900;NG RU&#7896;T',			// Benh duong ruot
	'T&#431; V&#7844;N GIA &#272;&#204;NH',					// Tu van gia dinh
	'T&#431; V&#7844;N NU&#212;I D&#7840;Y TR&#7866;',		// Tu van nuoi day tre
	'NH&#192; &#272;&#7864;P',								// Nha dep
	'T&#431; V&#7844;N',									// Tu van
	'D&#7920; &#193;N',										// Du an
	'KI&#7870;N TR&#218;C',									// Kien truc
	'V&#7852;T LI&#7878;U',									// Vat lieu
	'M&#212;I GI&#7898;I',									// Moi gioi
	'L&#296;NH V&#7920;C KH&#193;C'							// Linh vuc khac	
);

var menu_path = new Array(
	'/GL/Home/',
	'/GL/Xa-hoi/',
	'/GL/The-gioi/',
	'/GL/Kinh-doanh/',
	'/GL/Van-hoa/',
	'/GL/The-thao/',
	//'/GL/Euro/',
	'/GL/Phap-luat/',
	'/GL/Doi-song/',
	'/GL/Khoa-hoc/',
	'/GL/Vi-tinh/',
	'/GL/Oto-Xe-may/',
	'/GL/Ban-doc-viet/',
	'/GL/Ban-doc-viet/Tam-su/',
	'/User/Rao-vat/',
	'/GL/Cuoi/',
	'/GL/Anh/',
	'/GL/Video/',
	//'/GL/The-gioi/Bau-cu/',
	'/GL/The-gioi/Cuoc-song-do-day/',
	'/GL/The-gioi/Anh/',
	'/GL/The-gioi/Dieu-tra/',	
	'/GL/The-gioi/Nguoi-Viet-5-chau/',
	'/GL/The-gioi/Phan-tich/',
	'/GL/The-gioi/Tu-lieu/',
	'http://ebank.vnexpress.net/GL/Ebank/',
	'/GL/Kinh-doanh/Chung-khoan/',
	'/GL/Kinh-doanh/Bat-dong-san/',
	'/GL/Kinh-doanh/Kinh-nghiem/',
	'/GL/Kinh-doanh/Quoc-te/',	
	'/GL/Doi-song/Mua-sam/',
	'/GL/Kinh-doanh/Doanh-nghiep-viet/',	
	'/GL/Kinh-doanh/Danh-ba/',
	//'/GL/Kinh-doanh/Kinh-nghiem/',	
	//'/GL/Sea-games/',
	'/GL/The-thao/Bong-da/',
	'/GL/The-thao/Tennis/',
	'/GL/The-thao/Chan-dung/',
	'/GL/The-thao/Anh-Video/',
	'/GL/Xa-hoi/Giao-duc/',
	'/GL/Xa-hoi/Nhip-dieu-tre/',	
	'/GL/Xa-hoi/Du-lich/',
	//'/GL/Xa-hoi/Loi-song/',
	'/GL/Xa-hoi/Co-hoi-Du-hoc/',	
	'/GL/Xa-hoi/Tuyen-sinh/',
	'/GL/Xa-hoi/Cong-dan-toan-cau/',
	'/GL/Oto-Xe-may/Tu-van/',	
	'/GL/Phap-luat/Hinh-su/',
	'/GL/Phap-luat/Ky-su/',
	'/GL/Phap-luat/Tu-van/',	
	'/GL/Van-hoa/Hoa-hau/',
	'/GL/Van-hoa/Guong-mat-Nghe-sy/',
	'/GL/Van-hoa/Am-nhac/',
	'/GL/Van-hoa/Thoi-trang/',	
	'/GL/Van-hoa/San-khau-Dien-anh/',
	'/GL/Van-hoa/My-thuat/',	
	'http://eVan.vnexpress.net/',
	'/GL/Khoa-hoc/Moi-truong/',
	'/GL/Khoa-hoc/Thien-nhien/',
	'/GL/Khoa-hoc/Anh/',
	'/GL/Khoa-hoc/Ky-thuat-moi/',	
	//'/GL/Khoa-hoc/Tam-ly/',
	//'/GL/Khoa-hoc/Ban-co-biet/',
	'/GL/Vi-tinh/San-pham-moi/',
	'/GL/Vi-tinh/Kinh-nghiem/',
	'/GL/Vi-tinh/Giai-tri/',
	'/GL/Vi-tinh/Hoi-dap/',
	'/GL/Vi-tinh/Hacker-Virus/',
	'/GL/Cuoi/Tieu-pham/',
	'/GL/Cuoi/Video/',
	'/GL/Ban-doc-viet/The-gioi/',
	'/GL/Ban-doc-viet/Van-hoa/',
	'/GL/Ban-doc-viet/The-thao/',
	'/GL/Ban-doc-viet/Kinh-doanh/',
	'/GL/Ban-doc-viet/Xa-hoi/',
	'/GL/Ban-doc-viet/Phap-luat/',
	'/GL/Ban-doc-viet/Doi-song/',
	'/GL/Ban-doc-viet/Khoa-hoc/',	
	'/GL/Doi-song/Gia-dinh/',	
	'/GL/Suc-khoe/',
	'/GL/Doi-song/Am-thuc/',
	'/GL/Suc-khoe/Gioi-tinh/',
	'/GL/Suc-khoe/Lam-dep/',
	'/GL/Doi-song/Blog/',
	'/GL/Doi-song/Thuoc-Thuc-pham/',
	'/GL/Doi-song/Benh-duong-ruot/',
	'/GL/Suc-khoe/Tu-van/',
	'/GL/Doi-song/Tu-van-nuoi-day-tre/',
	'/GL/Kinh-doanh/Bat-dong-san/Nha-dep/',
	'/GL/Kinh-doanh/Bat-dong-san/Tu-van/',
	'/GL/Kinh-doanh/Bat-dong-san/Du-an/',
	'/GL/Kinh-doanh/Danh-ba/Kien-truc/',
	'/GL/Kinh-doanh/Danh-ba/Vat-lieu/',
	'/GL/Kinh-doanh/Danh-ba/Moi-gioi/',
	'/GL/Kinh-doanh/Danh-ba/Linh-vuc-khac/'
);

var menu_show = new Array(
	0,	// Trang nhat
	0,	// Xa hoi
	0,	// The gioi
	0,	// Kinh doanh
	0,	// Van hoa
	0,	// The thao
	//0,	// Euro 2008
	0,	// Phap luat
	0,	// Doi song
	0,	// Khoa hoc
	0,	// Vi tinh
	0,	// O to - Xe may
	0,	// Ban doc viet
	0,	// Tam su
	0,	// Rao vat
	0,	// Cuoi
	1,	// Anh
	1,	// Video
	//0,	// Bau cu My
	0,	// Cuoc song do day
	0,	// Anh
	0,	// Vu an	
	0,	// Nguoi Viet 5 Chau
	0,	// Phan tich
	0,	// Tai lieu
	0,	// Ebank
	0,	// Chung khoan
	0,	// Bat dong san
	0,	// Doanh nhan
	0,	// Quoc te	
	0,	// Mua sam
	0,	// Doanh nghiep Viet	
	0,	// Danh ba
	//0,	// Hoi nhap		
	//0,	// Seagames
	0,	// Bong da
	0,	// Tennis
	0,	// Chan dung
	0,	// Anh - Video
	0,	// Giao duc
	0,	// Nhip dieu tre	
	0,	// Du lich
	//0,	// Loi song
	0,	// Du hoc	
	0,	// Tuyen sinh
	1,	// Cong dan toan cau
	0,	// Tu van
	0,	// Hinh su
	0,	// Ky su
	0,	// Tu van		
	0,	// Hoa hau
	0,	// Nghe sy
	0,	// Am nhac
	0,	// Thoi trang	
	0,	// Dien anh
	0,	// My thuat	
	0,	// Van hoc	
	0,	// Moi truong
	0,	// Thien nhien
	0,	// Anh
	0,	// Cong nghe moi	
	//0,	// Tam ly
	//0,	// Chuyen do day
	0,	// San pham moi
	0,	// Kinh nghiem
	0,	// Giai tri
	0,	// Hoi dap
	0,	// Hacker & Virus
	0,	// Tieu pham
	0,	// Video	
	0,	// The gioi
	0,	// Van hoa
	0,	// The thao
	0,	// Kinh doanh
	0,	// Xa hoi
	0,	// Phap luat
	0,	// Doi song
	0,	// Khoa hoc	
	0,	// Gia dinh	
	0,	// Suc khoe
	0,	// Am thuc
	0,	// Gioi tinh
	0,	// Lam dep
	0,	// Cua so Blog
	1,	// Thuoc - Thuc pham
	1,	// Benh duong ruot
	0,	// Tu van gia dinh
	0,	// Tu van nuoi day tre
	0,	// Nha dep
	0,	// Tu van
	0,	// Du an
	0,	// Kien truc
	0,	// Vat lieu
	0,	// Moi gioi
	0	// Linh vuc khac
);