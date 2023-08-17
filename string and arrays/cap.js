function cap(str){
let str1 = str.split(" ")

for(let i =0; i<str1.length; i++){
     str1[i] = str1[i][0].toUpperCase()+ str1[i].slice(1)
}
    return str1.join(" ")
}
console.log(cap("mani kumar"))