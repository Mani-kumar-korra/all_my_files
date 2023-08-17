function appendstr(position){
    let str1="hello world"
    let str2="javascript"
return str1.slice(0, position)+ str2+str1.slice(position)

}

console.log(appendstr(5))