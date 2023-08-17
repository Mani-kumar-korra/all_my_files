function abb(str){

    let newStr =str.split(" ")
    return newStr[0]+" "+newStr[1].charAt(0)+"."
}

console.log(abb("raj kumar"))


