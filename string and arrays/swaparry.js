function swapcase(str){
    let swapped =""
for(let i=0;i<str.length;i++){
let char=str[i]
if(char===char.toUpperCase()){
    swapped+=char.toLowerCase()
}
else if(char===char.toLowerCase()){
    swapped+=char.toUpperCase()
}
else{
    swapped+=char
}

}
return swapped
}

console.log(swapcase("The Quick Brown Fox"))