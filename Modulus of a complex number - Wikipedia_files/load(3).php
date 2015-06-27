mw.log.deprecate(window,'insertAfter',function(parent,node,referenceNode){parent.insertBefore(node,referenceNode.nextSibling);},'Use jQuery\'s .after() or .insertAfter() instead.');mw.log.deprecate(window,'getElementsByClass',function(searchClass,node,tag){if(node==null){node=document;}if(tag==null){tag='*';}return $.makeArray($(node).find(tag+'.'+searchClass));},'Use $( \'.someClass\' ) or $( element ).find( \'.someClass\' ) instead.');mw.log.deprecate(window,'isClass',function(element,classe){return $(element).hasClass(classe);},'Use $( element ).hasClass( \'class\' ) instead.');mw.log.deprecate(window,'whichClass',function(element,classes){var s=' '+element.className+' ';for(var i=0;i<classes.length;i++){if(s.indexOf(' '+classes[i]+' ')>=0){return i;}}return-1;},'Use jQuery instead.');mw.log.deprecate(window,'hasClass',function(node,className){return $(node).hasClass(className);},'Use $( element ).hasClass( \'class\' ) instead.');mw.log.deprecate(window,'addClass',function(node,
className){if($(node).hasClass(className)){return false;}var cache=node.className;if(cache){node.className=cache+' '+className;}else{node.className=className;}return true;},'Use $( element ).addClass( \'className\' ) instead.');function eregReplace(search,replace,subject){return subject.replace(new RegExp(search,'g'),replace);}mw.log.deprecate(window,'removeClass',function(node,className){if(!$(node).hasClass(className)){return false;}node.className=eregReplace('(^|\\s+)'+className+'($|\\s+)',' ',node.className);return true;},'Use $( element ).removeClass( \'className\' ) instead.');window.createAdressNode=function(href,texte,onclick){var a=document.createElement('a');a.href=href;a.appendChild(document.createTextNode(texte));if(arguments.length==3){a.setAttribute("onclick",onclick);}return a;};window.setCookie=function(nom,valeur,duree){var expDate=new Date();expDate.setTime(expDate.getTime()+(duree*24*60*60*1000));document.cookie=nom+"="+escape(valeur)+";expires="+expDate.toGMTString(
)+";path=/";};window.getCookieVal=function(name){var cookiePos=document.cookie.indexOf(name+"=");var cookieValue=false;if(cookiePos>-1){cookiePos+=name.length+1;var endPos=document.cookie.indexOf(";",cookiePos);if(endPos>-1)cookieValue=document.cookie.substring(cookiePos,endPos);else cookieValue=document.cookie.substring(cookiePos);}return cookieValue;};window.getTextContent=function(oNode){if(!oNode)return null;if(typeof oNode.textContent!=="undefined"){return oNode.textContent;}switch(oNode.nodeType){case 3:case 4:return oNode.nodeValue;break;case 7:case 8:if(getTextContent.caller!=getTextContent){return oNode.nodeValue;}break;case 9:case 10:case 12:return null;break;}var _textContent="";oNode=oNode.firstChild;while(oNode){_textContent+=getTextContent(oNode);oNode=oNode.nextSibling;}return _textContent;};if(!Array.prototype.indexOf){Array.prototype.indexOf=function(obj){for(var i=0;i<this.length;i++){if(this[i]==obj){return i;}}return-1;};}if(!String.prototype.HTMLize){String.
prototype.HTMLize=function(){var chars=['&','<','>','"'];var entities=['amp','lt','gt','quot'];var string=this;for(var i=0;i<chars.length;i++){var regex=new RegExp(chars[i],'g');string=string.replace(regex,'&'+entities[i]+';');}return string;};}mw.log.deprecate(window,'addLoadEvent',function(hookFunct){$(function(){hookFunct();});},'Use jQuery instead.');mw.log.deprecate(window,'loadJs',importScript,'Use importScript instead.');window.obtenir=function(name){importScript('MediaWiki:Gadget-'+name+'.js');};function TransformeEnDiscussion($){if(mw.config.get('wgPageName').search('Wikipédia:Le_Bistro')!=-1||mw.config.get('wgPageName').search('Wikipédia:Bulletin_des_administrateurs')!=-1||$('#transformeEnPageDeDiscussion').length){$('body').removeClass('ns-subject').addClass('ns-talk');}}$(TransformeEnDiscussion);if(typeof addCustomButton==='undefined'){mw.log.deprecate(window,'addCustomButton',function(imageFile,speedTip,tagOpen,tagClose,sampleText,imageId){if(mw.toolbar){mw.toolbar.
addButton({imageFile:imageFile.replace(/^http:(\/\/upload.wikimedia.org\/)/,'$1'),speedTip:speedTip,tagOpen:tagOpen,tagClose:tagClose,sampleText:sampleText,imageId:imageId});}},'Use mw.toolbar.addButton instead.');}if(['edit','submit'].indexOf(mw.config.get('wgAction'))!==-1){importScript('MediaWiki:Common.js/edit.js');}function rewritePageTitle($){var $realTitle,titleText,$h1,$realTitleBanner=$('#RealTitleBanner');if($realTitleBanner.length&&!$('#DisableRealTitle').length){$realTitle=$('#RealTitle');$h1=$('h1:first');if($realTitle.length&&$h1.length){titleText=$realTitle.html();if(titleText===''){$h1.hide();}else{$h1.html(titleText);}$realTitleBanner.hide();$('<p>').css('font-size','80%').html('Titre à utiliser pour créer un lien interne : <b>'+mw.config.get('wgPageName').replace(/_/g,' ')+'</b>').insertAfter($h1);}}}$(rewritePageTitle);function moveCoord($){$('#coordinates').addClass('coordinates-title').insertBefore('#firstHeading');}$(moveCoord);function sousTitreH1($content){$(
'#firstHeading > #sous_titre_h1').remove();var $span=$content.find('#sous_titre_h1');if($span.length){$span.prepend(' ');$('#firstHeading').append($span);}}mw.hook('wikipage.content').add(sousTitreH1);var Palette_Enrouler='[masquer]';var Palette_Derouler='[afficher]';var Palette_max=1;function Palette_toggle($table){$table.find('tr:not(:first)').toggleClass('navboxHidden');}function Palette(element){if(!element){element=document;}var $tables=$(element).find('table.collapsible');var autoCollapse=$tables.length>Palette_max;$.each($tables,function(_,table){var $table=$(table);var collapsed=$table.hasClass('collapsed')||(autoCollapse&&$table.hasClass('autocollapse'));$table.find('tr:first th:first').prepend($('<span class="navboxToggle">\u00a0</span>').append($('<a href="#">'+(collapsed?Palette_Derouler:Palette_Enrouler)+'</a>').click(function(){if($(this).text()===Palette_Enrouler){$(this).text(Palette_Derouler);}else{$(this).text(Palette_Enrouler);}Palette_toggle($table);return false;}))
);if(collapsed){Palette_toggle($table);}});}$(function(){Palette();});var BoiteDeroulante_Enrouler='[masquer]';var BoiteDeroulante_Derouler='[afficher]';var BoiteDeroulante_max=0;var BoiteDeroulante_index=-1;function BoiteDeroulante_toggle(indexBoiteDeroulante){var NavFrame=document.getElementById("NavFrame"+indexBoiteDeroulante);var NavToggle=document.getElementById("NavToggle"+indexBoiteDeroulante);var CaptionContainer=document.getElementById("NavCaption"+indexBoiteDeroulante);if(!NavFrame||!NavToggle||!CaptionContainer)return;var caption=[];var CaptionSpans=CaptionContainer.getElementsByTagName('span');caption[0]=CaptionSpans[0].innerHTML;caption[1]=CaptionSpans[1].innerHTML;var Contents=NavFrame.getElementsByTagName('div');if(NavToggle.innerHTML==caption[1]){NavToggle.innerHTML=caption[0];for(var a=0,m=Contents.length;a<m;a++){if($(Contents[a]).hasClass('NavContent')){Contents[a].style.display='none';return;}}}else{NavToggle.innerHTML=caption[1];for(var a=0,m=Contents.length;a<m;a++
){if($(Contents[a]).hasClass("NavContent")){Contents[a].style.display='block';return;}}}}function BoiteDeroulante(Element){if(!Element)Element=document;var NavFrameCount=-1;var NavFrames=Element.getElementsByTagName("div");for(var i=0,l=NavFrames.length;i<l;i++){if($(NavFrames[i]).hasClass('NavFrame')){var NavFrame=NavFrames[i];NavFrameCount++;BoiteDeroulante_index++;if(NavFrame.title&&NavFrame.title.indexOf("/")!=-1){var Enrouler=NavFrame.title.HTMLize().split("/")[1];var Derouler=NavFrame.title.HTMLize().split("/")[0];}else{var Enrouler=BoiteDeroulante_Enrouler;var Derouler=BoiteDeroulante_Derouler;}NavFrame.title='';var CaptionContainer=document.createElement('span');CaptionContainer.id='NavCaption'+BoiteDeroulante_index;CaptionContainer.style.display="none";CaptionContainer.innerHTML='<span>'+Derouler+'</span><span>'+Enrouler+'</span>';NavFrame.appendChild(CaptionContainer);var NavToggle=document.createElement("a");NavToggle.className='NavToggle';NavToggle.id='NavToggle'+
BoiteDeroulante_index;NavToggle.href='javascript:BoiteDeroulante_toggle('+BoiteDeroulante_index+');';var NavToggleText=document.createTextNode(Enrouler);NavToggle.appendChild(NavToggleText);NavFrame.insertBefore(NavToggle,NavFrame.firstChild);NavFrame.id='NavFrame'+BoiteDeroulante_index;if(BoiteDeroulante_max<=NavFrameCount){BoiteDeroulante_toggle(BoiteDeroulante_index);}}}}$(function(){BoiteDeroulante();});var Diaporama={};Diaporama.Params={};Diaporama.Fonctions={};Diaporama.Params.DiaporamaIndex=0;Diaporama.Params.ImageDelay=1;Diaporama.Params.Paused=[];Diaporama.Params.Visible=[];Diaporama.Params.Length=[];Diaporama.Params.Delay=[];Diaporama.Params.Timeout=[];Diaporama.Fonctions.Init=function(node){if(!node)node=document;var Diaporamas=$(node).find('div.diaporama').get();for(var a=0,l=Diaporamas.length;a<l;a++){Diaporama.Fonctions.InitDiaporama(Diaporamas[a]);}};Diaporama.Fonctions.InitDiaporama=function(DiaporamaDiv){var index=Diaporama.Params.DiaporamaIndex;Diaporama.Params.
DiaporamaIndex++;DiaporamaDiv.id="Diaporama_"+index;var DiaporamaFileContainer=$(DiaporamaDiv).find('div.diaporamaFiles')[0];var DiaporamaControl=$(DiaporamaDiv).find('div.diaporamaControl')[0];if(!DiaporamaFileContainer||!DiaporamaControl)return;var DiaporamaFiles=$(DiaporamaFileContainer).find('div.ImageFile').get();var width;var firstTumbinner=$(DiaporamaFileContainer).find('div.thumbinner')[0];if(firstTumbinner){width=firstTumbinner.style.width.split("px").join("");}else{if(DiaporamaFileContainer.firstChild.firstChild)width=DiaporamaFileContainer.firstChild.firstChild.offsetWidth;}if(width)DiaporamaDiv.style.width=(parseInt(width)+30)+"px";if(DiaporamaFiles.length<2)return;Diaporama.Params.Length[index]=DiaporamaFiles.length;DiaporamaFileContainer.id="DiaporamaFileContainer_"+index;DiaporamaControl.id="DiaporamaControl_"+index;Diaporama.Params.Delay[index]=Diaporama.Params.ImageDelay;var DiaporamaDivClass=DiaporamaDiv.className.HTMLize();var ParamDelay=DiaporamaDivClass.match(
/Delay[0-9]+(\.|,)?[0-9]*/);if(ParamDelay!=null){ParamDelay=parseFloat(ParamDelay[0].split("Delay").join("").split(",").join("."));if(ParamDelay&&ParamDelay>0)Diaporama.Params.Delay[index]=ParamDelay;}Diaporama.Fonctions.ShowThisDiapo(index,0);var ControlLinks=DiaporamaControl.getElementsByTagName("a");ControlLinks[0].firstChild.id="DiaporamaPlay"+index;ControlLinks[0].href="javascript:Diaporama.Fonctions.Play("+index+");";ControlLinks[1].firstChild.id="DiaporamaPause"+index;ControlLinks[1].href="javascript:Diaporama.Fonctions.Pause("+index+");";ControlLinks[2].firstChild.id="DiaporamaStop"+index;ControlLinks[2].href="javascript:Diaporama.Fonctions.Stop("+index+");";ControlLinks[3].firstChild.id="DiaporamaLast"+index;ControlLinks[3].href="javascript:Diaporama.Fonctions.ToggleDiapo("+index+",-1);";ControlLinks[4].firstChild.id="DiaporamaNext"+index;ControlLinks[4].href="javascript:Diaporama.Fonctions.ToggleDiapo("+index+", 1);";ControlLinks[5].parentNode.appendChild(Diaporama.Fonctions.
CreateSelect(index,ControlLinks[5].title));ControlLinks[5].parentNode.removeChild(ControlLinks[5]);for(var e=0,t=ControlLinks.length;e<t;e++){ControlLinks[e].onmousedown=function(){Diaporama.Fonctions.Onclick(this);};ControlLinks[e].onmouseup=function(){Diaporama.Fonctions.Offclick(this,index);};ControlLinks[e].firstChild.style.backgroundColor="white";ControlLinks[e].onmouseover=function(){this.focus();};}DiaporamaControl.style.display="block";if($(DiaporamaDiv).hasClass('Autoplay')){Diaporama.Fonctions.Play(index);}else{Diaporama.Fonctions.Pause(index);}};Diaporama.Fonctions.Play=function(index){if(Diaporama.Params.Paused[index]===false)return;Diaporama.Params.Paused[index]=false;clearTimeout(Diaporama.Params.Timeout[index]);Diaporama.Params.Timeout[index]=setTimeout("Diaporama.Fonctions.ToggleDiapo("+index+",1);",Diaporama.Params.Delay[index]*1000);var ButtonPlay=document.getElementById("DiaporamaPlay"+index);ButtonPlay.style.backgroundColor="silver";var ButtonPause=document.
getElementById("DiaporamaPause"+index);ButtonPause.style.backgroundColor="white";var ButtonStop=document.getElementById("DiaporamaStop"+index);ButtonStop.style.backgroundColor="white";};Diaporama.Fonctions.Pause=function(index){Diaporama.Params.Paused[index]=true;clearTimeout(Diaporama.Params.Timeout[index]);var ButtonPlay=document.getElementById("DiaporamaPlay"+index);ButtonPlay.style.backgroundColor="white";var ButtonPause=document.getElementById("DiaporamaPause"+index);ButtonPause.style.backgroundColor="silver";var ButtonStop=document.getElementById("DiaporamaStop"+index);ButtonStop.style.backgroundColor="white";};Diaporama.Fonctions.Stop=function(index){Diaporama.Params.Paused[index]=true;clearTimeout(Diaporama.Params.Timeout[index]);Diaporama.Fonctions.ShowThisDiapo(index,0);var ButtonPlay=document.getElementById("DiaporamaPlay"+index);ButtonPlay.style.backgroundColor="white";var ButtonPause=document.getElementById("DiaporamaPause"+index);ButtonPause.style.backgroundColor="white";
var ButtonStop=document.getElementById("DiaporamaStop"+index);ButtonStop.style.backgroundColor="silver";};Diaporama.Fonctions.ToggleDiapo=function(index,diff){clearTimeout(Diaporama.Params.Timeout[index]);var DiaporamaFileContainer=document.getElementById("DiaporamaFileContainer_"+index);var DiaporamaFiles=$(DiaporamaFileContainer).find('div.ImageFile').get();var VisibleIndex=Diaporama.Params.Visible[index];var NextDiaporamaIndex=(VisibleIndex+diff);if(NextDiaporamaIndex==DiaporamaFiles.length||NextDiaporamaIndex<0){var DiaporamaDiv=document.getElementById("Diaporama_"+index);if(diff<0||!$(DiaporamaDiv).hasClass('AutoLoop')){return;}NextDiaporamaIndex=0;}Diaporama.Fonctions.ShowThisDiapo(index,NextDiaporamaIndex);};Diaporama.Fonctions.ShowThisDiapo=function(index,Value){clearTimeout(Diaporama.Params.Timeout[index]);var DiaporamaFileContainer=document.getElementById("DiaporamaFileContainer_"+index);var DiaporamaFiles=$(DiaporamaFileContainer).find('div.ImageFile').get();for(var x=0,z=
DiaporamaFiles.length;x<z;x++){if(x!=Value){DiaporamaFiles[x].style.display="none";}else{DiaporamaFiles[x].style.display="block";}}Diaporama.Params.Visible[index]=Value;Diaporama.Fonctions.UpdateBar(index);Diaporama.Fonctions.UpdateSelect(index);if(!Diaporama.Params.Paused[index]){var multipl=1;if(Value==(Diaporama.Params.Length[index]-1))multipl=3;Diaporama.Params.Timeout[index]=setTimeout("Diaporama.Fonctions.ToggleDiapo("+index+",1);",Diaporama.Params.Delay[index]*1000*multipl);}};Diaporama.Fonctions.CreateSelect=function(index,Title){var Total=Diaporama.Params.Length[index];var Select=document.createElement('select');Select.id="DiaporamaSelect"+index;Select.title=Title;for(var s=0;s<Total;s++){var Opt=document.createElement('option');if(s==0)Opt.selected="selected";Opt.text=(s+1)+"/"+Total;Opt.innerHTML=(s+1)+"/"+Total;Opt.value=s;Select.appendChild(Opt);}Select.onchange=function(){Diaporama.Fonctions.SelectDiapo(Diaporama.Fonctions.getIndex(this));};Select.onmouseover=function(){
this.focus();};return Select;};Diaporama.Fonctions.SelectDiapo=function(index){var Select=document.getElementById("DiaporamaSelect"+index);if(!Select)return;var Opts=Select.getElementsByTagName('option');for(var o=0,p=Opts.length;o<p;o++){if(Opts[o].selected){var Value=parseInt(Opts[o].value);return Diaporama.Fonctions.ShowThisDiapo(index,Value);}}};Diaporama.Fonctions.UpdateSelect=function(index){var Select=document.getElementById("DiaporamaSelect"+index);if(!Select)return;var Opts=Select.getElementsByTagName('option');for(var o=0,p=Opts.length;o<p;o++){if(o==Diaporama.Params.Visible[index]){Opts[o].selected="selected";}else{Opts[o].selected=false;}}};Diaporama.Fonctions.UpdateBar=function(index){var Percent=(100/(Diaporama.Params.Length[index]-1))*Diaporama.Params.Visible[index];if(Percent>100)Percent=100;var DiaporamaControl=document.getElementById("DiaporamaControl_"+index);var DiaporamaScrollBar=$(DiaporamaControl).find('div.ScrollBar')[0];DiaporamaScrollBar.style.width=Percent+
"%";};Diaporama.Fonctions.Onclick=function(Link){var Image=Link.getElementsByTagName('img')[0];Image.style.backgroundColor="gray";};Diaporama.Fonctions.Offclick=function(Link,index){var Span=Link.parentNode;var SpanClass=Span.className;var Image=Link.getElementsByTagName('img')[0];var DiapoState=Diaporama.Params.Paused[index];if(($(Span).hasClass('Play')&&DiapoState==false)||(($(Span).hasClass('Pause')||$(Span).hasClass('Stop'))&&DiapoState==true)){Image.style.backgroundColor="silver";}else{Image.style.backgroundColor="white";}};Diaporama.Fonctions.getIndex=function(Element){return parseInt(Element.id.replace(/[^0-9]/g,""));};$(function(){Diaporama.Fonctions.Init();});function hiddencat($){if(typeof DesactiveHiddenCat!=="undefined"&&DesactiveHiddenCat)return;if(document.URL.indexOf("printable=yes")!=-1)return;var cl=document.getElementById('catlinks');if(!cl)return;var $hc=$('#mw-hidden-catlinks');if(!$hc.length)return;if($hc.hasClass('mw-hidden-cats-user-shown'))return;if($hc.hasClass
('mw-hidden-cats-ns-shown'))$hc.addClass('mw-hidden-cats-hidden');var nc=document.getElementById('mw-normal-catlinks');if(!nc){var catline=document.createElement('div');catline.id='mw-normal-catlinks';var a=document.createElement('a');a.href='/wiki/Catégorie:Accueil';a.title='Catégorie:Accueil';a.appendChild(document.createTextNode('Catégories'));catline.appendChild(a);catline.appendChild(document.createTextNode(' : '));nc=cl.insertBefore(catline,cl.firstChild);}else nc.appendChild(document.createTextNode(' | '));var lnk=document.createElement('a');lnk.id='mw-hidden-cats-link';lnk.title='Cet article contient des catégories cachées';lnk.style.cursor='pointer';lnk.style.color='black';$(lnk).click(toggleHiddenCats);lnk.appendChild(document.createTextNode('[+]'));nc.appendChild(lnk);}function toggleHiddenCats(e){var $hc=$('#mw-hidden-catlinks');if($hc.hasClass('mw-hidden-cats-hidden')){$hc.removeClass('mw-hidden-cats-hidden');$hc.addClass('mw-hidden-cat-user-shown');$(e.target).text(
'[–]');}else{$hc.removeClass('mw-hidden-cat-user-shown');$hc.addClass('mw-hidden-cats-hidden');$(e.target).text('[+]');}}$(hiddencat);function GeoBox_Init(Element){if(!Element)Element=document.body;var cont=$(Element).find('div.img_toogle').get();for(var i=0,m=cont.length;i<m;i++){cont[i].id='img_toogle_'+i;var Boxes=$(cont[i]).find('.geobox').get();var ToggleLinksDiv=document.createElement('ul');ToggleLinksDiv.id='geoboxToggleLinks_'+i;for(var a=0,l=Boxes.length;a<l;a++){var ThisBox=Boxes[a];ThisBox.id='geobox_'+i+"_"+a;ThisBox.style.borderTop='0';var ThisAlt=ThisBox.getElementsByTagName('img')[0].alt;var toggle=document.createElement('a');toggle.id='geoboxToggle_'+i+"_"+a;toggle.appendChild(document.createTextNode(ThisAlt));toggle.href='javascript:;';toggle.onclick=function(){GeoBox_Toggle(this);return false;};var Li=document.createElement('li');Li.appendChild(toggle);ToggleLinksDiv.appendChild(Li);if(a==(l-1)){Li.style.display="none";}else{ThisBox.style.display="none";}}cont[i].
appendChild(ToggleLinksDiv);}}function GeoBox_Toggle(link){var ImgToggleIndex=link.id.split('geoboxToggle_').join('').replace(/_.*/g,"");var GeoBoxIndex=link.id.replace(/.*_/g,"");var ImageToggle=document.getElementById('img_toogle_'+ImgToggleIndex);var Links=document.getElementById('geoboxToggleLinks_'+ImgToggleIndex);var Geobox=document.getElementById('geobox_'+ImgToggleIndex+"_"+GeoBoxIndex);var Link=document.getElementById('geoboxToggle_'+ImgToggleIndex+"_"+GeoBoxIndex);if((!ImageToggle)||(!Links)||(!Geobox)||(!Link))return;var AllGeoboxes=$(ImageToggle).find('.geobox').get();for(var a=0,l=AllGeoboxes.length;a<l;a++){var ThisgeoBox=AllGeoboxes[a];if(ThisgeoBox.id===Geobox.id){ThisgeoBox.style.display="";}else{ThisgeoBox.style.display="none";}}var AllToggleLinks=Links.getElementsByTagName('a');for(var a=0,l=AllToggleLinks.length;a<l;a++){var thisToggleLink=AllToggleLinks[a];if(thisToggleLink.id===Link.id){thisToggleLink.parentNode.style.display="none";}else{thisToggleLink.parentNode
.style.display="";}}}if(['view','submit'].indexOf(mw.config.get('wgAction'))!==-1){$(function(){GeoBox_Init();});}function rewritePageH1bis(){try{var helpPage=document.getElementById("helpPage");if(helpPage){var helpPageURL=document.getElementById("helpPageURL");var h1=document.getElementById('firstHeading');if(helpPageURL&&h1){h1.innerHTML=h1.innerHTML+'<span id="h1-helpPage">'+helpPageURL.innerHTML+'</span>';helpPage.style.display="none";}}}catch(e){}}$(rewritePageH1bis);function addcache(element){if(typeof no_external_cache!=="undefined"&&no_external_cache){return;}var liens=element?$(element).find('ol.references').find('a.external'):$('ol.references').find('a.external');for(var i=0,l=liens.length;i<l;i++){var lien_en_cours=liens[i];var chemin=lien_en_cours.href;if(chemin.indexOf("http://archive.wikiwix.com/cache/")>-1||chemin.indexOf("http://web.archive.org/web/")>-1||chemin.indexOf("wikipedia.org")>-1||chemin.indexOf("wikimedia.org")>-1){continue;}var element_parent=lien_en_cours.
parentNode;if($(element_parent).hasClass('noarchive')){continue;}var titre=getTextContent(lien_en_cours);var last=document.createElement("small");last.className="cachelinks";last.appendChild(document.createTextNode("\u00a0["));var link=document.createElement("a");link.setAttribute("href","http://archive.wikiwix.com/cache/?url="+chemin.replace(/%/g,"%25").replace(/&/g,"%26")+"&title="+encodeURIComponent(titre));link.setAttribute("title","archive de "+titre);link.appendChild(document.createTextNode("archive"));last.appendChild(link);last.appendChild(document.createTextNode("]"));element_parent.insertBefore(last,lien_en_cours.nextSibling);}}if(mw.config.get('wgNamespaceNumber')===0){$(function(){addcache();});}$(function($){$('.sortable th').attr('tabindex',0).keypress(function(event){if(event.which==13){$(this).click();}});});if(mw.config.get('wgNamespaceNumber')>=0){mw.loader.using(['mediawiki.RegExp','mediawiki.util']).done(function(){mw.hook('wikipage.content').add(function($content){
var uploadBaseRe=/^\/\/upload\.wikimedia\.org\/wikipedia\/commons/,localBasePath=new RegExp('^'+mw.RegExp.escape(mw.util.getUrl(mw.config.get('wgFormattedNamespaces')['6']+':'))),localBaseScript=new RegExp('^'+mw.RegExp.escape(mw.util.wikiScript()+'?title='+mw.util.wikiUrlencode(mw.config.get('wgFormattedNamespaces')['6']+':'))),commonsBasePath='//commons.wikimedia.org/wiki/File:',commonsBaseScript='//commons.wikimedia.org/w/index.php?title=File:';$content.find('a.image').attr('href',function(i,currVal){if(uploadBaseRe.test($(this).find('img').attr('src'))){return currVal.replace(localBasePath,commonsBasePath).replace(localBaseScript,commonsBaseScript);}});});});}$(function($){var $newSectionLink=$('#ca-addsection a');if($newSectionLink.length){var link=$newSectionLink.clone();link.removeAttr('accesskey').attr('title',function(index,oldTitle){return oldTitle.replace(/\s*\[.*\]\s*$/,'');});var lastEditsectionLink=$('span.mw-editsection:last a:last');lastEditsectionLink.after(link);
lastEditsectionLink.after(' | ');}});if(mw.config.get('wgIsMainPage')){mw.loader.using(['mediawiki.util'],function(){$(function(){mw.util.addPortletLink('p-lang','//www.wikipedia.org/','Liste complète','interwiki-listecomplete','Liste complète des Wikipédias');});});}if(mw.config.get('wgNamespaceNumber')===-1){if(mw.config.get('wgCanonicalSpecialPageName')==='Upload'){importScript('MediaWiki:Onlyifuploading.js');}if(mw.config.get('wgCanonicalSpecialPageName')==='EditTags'){(function(){var TagsToHide=['AWB','BandeauxCategories','BandeauxEbauches','BandeauxPortails','HotCats','LiveRC','PaFtec','PaStec','Popups','RenommageCategorie','WPCleaner'];var trytodeletesometags=function(){var permissionError=$.makeArray($(document).find("div.permissions-errors"));if(permissionError.length>0)return;var a,l;var Container=document.getElementById("mw_edittags_tag_list_chzn");if(Container){var choices=$.makeArray($(Container).find("li.search-choice"));for(a=0,l=choices.length;a<l;a++){var thischoice
=choices[a];var thischoicetext=thischoice.firstChild.innerHTML;if(TagsToHide.indexOf(thischoicetext)!==-1){var deletelink=thischoice.getElementsByTagName('a')[0];if(deletelink){deletelink.parentNode.removeChild(deletelink);thischoice.style.paddingLeft="5px";thischoice.style.paddingRight="5px";}}}var activeresult=$.makeArray($(Container).find("li.active-result"));for(a=0,l=activeresult.length;a<l;a++){var thisactiveresult=activeresult[a];var thisactiveresulttext=thisactiveresult.innerHTML;if(TagsToHide.indexOf(thisactiveresulttext)!==-1)thisactiveresult.parentNode.removeChild(thisactiveresult);}}var Checkboxes=$.makeArray($(document).find("input.mw-edittags-remove-checkbox"));var canremoveall=true;for(a=0,l=Checkboxes.length;a<l;a++){var thischeckbox=Checkboxes[a];if(TagsToHide.indexOf(thischeckbox.value)!==-1){thischeckbox.disabled="disabled";canremoveall=false;}}if(!canremoveall){var removeall=document.getElementById("mw-edittags-remove-all");if(removeall)removeall.disabled="disabled"
;}};mw.loader.using("mediawiki.special.edittags",function(){$(trytodeletesometags);});})();}}if(mw.config.get('wgNamespaceNumber')===2){function CadreOngletInitN($){var Classeurs=$('div.classeur');for(var i=0;i<Classeurs.length;i++){var Classeur=Classeurs[i];Classeur.setAttribute("id","classeur"+i);var vOgIni=-1;var Onglets=$(Classeur).children("div").eq(0).children("div");var Feuillets=$(Classeur).children("div").eq(1).children("div");for(var j=0;j<Onglets.length;j++){var Onglet=Onglets[j];var Feuillet=Feuillets[j];Onglet.setAttribute("id","classeur"+i+"onglet"+j);Feuillet.setAttribute("id","classeur"+i+"feuillet"+j);Onglet.onclick=CadreOngletVoirOngletN;if($(Onglet).hasClass('ongletBoutonSel'))vOgIni=j;}if(vOgIni==-1){var vOgIni=Math.floor((Onglets.length)*Math.random());document.getElementById("classeur"+i+"feuillet"+vOgIni).style.display="block";document.getElementById("classeur"+i+"feuillet"+vOgIni).style.visibility="visible";var vBtElem=document.getElementById("classeur"+i+
"onglet"+vOgIni);$(Onglet).removeClass("ongletBoutonNonSel");$(Onglet).addClass("ongletBoutonSel");vBtElem.style.cursor="default";vBtElem.style.backgroundColor="inherit";vBtElem.style.borderTopColor="inherit";vBtElem.style.borderRightColor="inherit";vBtElem.style.borderBottomColor="inherit";vBtElem.style.borderLeftColor="inherit";}}}function CadreOngletVoirOngletN(){var vOngletNom=this.id.substr(0,this.id.indexOf("onglet",1));var vOngletIndex=this.id.substr(this.id.indexOf("onglet",0)+6,this.id.length);var rule1=$('#'+vOngletNom+' .ongletBoutonNonSel')[0].style.backgroundColor.toString();var rule2=$('#'+vOngletNom+' .ongletBoutonNonSel')[0].style.borderColor.toString();var Onglets=$('#'+vOngletNom).children("div").eq(0).children("div");for(var j=0;j<Onglets.length;j++){var Onglet=Onglets[j];var Feuillet=document.getElementById(vOngletNom+"feuillet"+j);if(vOngletIndex==j){Feuillet.style.display="block";Feuillet.style.visibility="visible";$(Onglet).removeClass("ongletBoutonNonSel");$(
Onglet).addClass("ongletBoutonSel");Onglet.style.cursor="default";Onglet.style.backgroundColor="inherit";Onglet.style.borderTopColor="inherit";Onglet.style.borderRightColor="inherit";Onglet.style.borderBottomColor="inherit";Onglet.style.borderLeftColor="inherit";}else{Feuillet.style.display="none";Feuillet.style.visibility="hidden";$(Onglet).removeClass("ongletBoutonSel");$(Onglet).addClass("ongletBoutonNonSel");Onglet.style.cursor="pointer";Onglet.style.backgroundColor=rule1;Onglet.style.borderColor=rule2;}}return false;}$(CadreOngletInitN);}if(mw.config.get('wgNamespaceNumber')===104){function addBibSubsetMenu($){var specialBib=document.getElementById('specialBib');if(!specialBib)return;specialBib.style.display='block';menu='<select style="display:inline;" onChange="chooseBibSubset(selectedIndex)">'+'<option>Liste</option>'+'<option>WikiNorme</option>'+'<option>BibTeX</option>'+'<option>ISBD</option>'+'<option>ISO690</option>'+'</select>';specialBib.innerHTML=specialBib.innerHTML+
menu;chooseBibSubset(0);}function chooseBibSubset(s){var l=document.getElementsByTagName('div');for(var i=0;i<l.length;i++){if(l[i].className=='BibList')l[i].style.display=s==0?'block':'none';else if(l[i].className=='WikiNorme')l[i].style.display=s==1?'block':'none';else if(l[i].className=='BibTeX')l[i].style.display=s==2?'block':'none';else if(l[i].className=='ISBD')l[i].style.display=s==3?'block':'none';else if(l[i].className=='ISO690')l[i].style.display=s==4?'block':'none';}}$(addBibSubsetMenu);}function Rebours(){try{if(document.getElementById("rebours")){destime=document.getElementById("rebours").title.HTMLize().split(";;");Maintenant=(new Date()).getTime();Future=new Date(Date.UTC(destime[0],(destime[1]-1),destime[2],destime[3],destime[4],destime[5])).getTime();Diff=(Future-Maintenant);if(Diff<0){Diff=0;}TempsRestantJ=Math.floor(Diff/(24*3600*1000));TempsRestantH=Math.floor(Diff/(3600*1000))%24;TempsRestantM=Math.floor(Diff/(60*1000))%60;TempsRestantS=Math.floor(Diff/1000)%60;
TempsRestant=""+destime[6]+" ";if(TempsRestantJ==1){TempsRestant=TempsRestant+TempsRestantJ+" jour ";}else if(TempsRestantJ>1){TempsRestant=TempsRestant+TempsRestantJ+" jours ";}TempsRestant=TempsRestant+TempsRestantH+" h "+TempsRestantM+" min "+TempsRestantS+" s";document.getElementById("rebours").innerHTML=TempsRestant;setTimeout("Rebours()",1000);}}catch(e){}}if(mw.config.get('wgNamespaceNumber')!==0){$(Rebours);}function LastModCopy($){$('.lastmodcopy').html($('#lastmod, #footer-info-lastmod').html());}$(LastModCopy);if(mw.config.get('wgCanonicalSpecialPageName')==='Watchlist'){importScript('MediaWiki:Common.js/watchlist.js');}function getVarValue(nom_variable,val_defaut){var result=null;try{result=eval(nom_variable.toString());}catch(e){result=val_defaut;}return(result);}function getStrDateToday(format){var str_mois=[];with(str_mois){push("janvier");push("février");push("mars");push("avril");push("mai");push("juin");push("juillet");push("août");push("septembre");push("octobre");
push("novembre");push("décembre");}var today=new Date();var day=today.getDate();var year=today.getYear();if(year<2000){year=year+1900;}var str_date=format;var regex=/j/gi;str_date=str_date.replace(regex,day.toString());regex=/a/gi;str_date=str_date.replace(regex,year.toString());regex=/m/gi;str_date=str_date.replace(regex,str_mois[today.getMonth()]);return(str_date);};mw.loader.state({"site":"ready"});
/* cache key: frwiki:resourceloader:filter:minify-js:7:8a8903f42eac3f3a6f4a485d727d3023 */