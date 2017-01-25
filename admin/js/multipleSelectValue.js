function SelectValue(id,dis){
	var txt=document.getElementById(id).options[document.getElementById(id).selectedIndex].text;
	document.getElementById(dis).value=txt;
}