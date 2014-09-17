<script language="JavaScript1.2">


var line=new Array()
line[1]="  Benvenuto!"


var ts_fontsize="22px"

var longestmessage=1
for (i=2;i<line.length;i++){
if (line[i].length>line[longestmessage].length)
longestmessage=i
}

var tscroller_width=line[longestmessage].length

lines=line.length-1

if (document.all||document.getElementById){
document.write('<form name="bannerform">')
document.write('<input type="text" name="banner" size="'+tscroller_width+'"')
document.write('  style="padding:0 0 0 30px; background-color: transparent; color: black; font-family: verdana; font-size: '+ts_fontsize+'; font-weight:bold; border: medium none" onfocus="blur()">')
document.write('</form>')
}

temp=""
nextchar=-1;
nextline=1;
cursor="\\"
function animate(){
if (temp==line[nextline] & temp.length==line[nextline].length & nextline!=lines){
nextline++;
nextchar=-1;
document.bannerform.banner.value=temp;
temp="";
setTimeout("nextstep()",1000)}
else if (nextline==lines & temp==line[nextline] & temp.length==line[nextline].length){
nextline=1;
nextchar=-1;
document.bannerform.banner.value=temp;
temp="";
setTimeout("nextstep()",1000)}
else{
nextstep()}}

function nextstep(){

if (cursor=="\\"){
cursor="|"}
else if (cursor=="|"){
cursor="/"}
else if (cursor=="/"){
cursor="-"}
else if (cursor=="-"){
cursor="\\"}

nextchar++;
temp+=line[nextline].charAt(nextchar);
document.bannerform.banner.value=temp+cursor
setTimeout("animate()",25)}

if (document.all||document.getElementById)
window.onload=animate
// -->
</script>