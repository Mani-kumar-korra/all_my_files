myColor = ["Red", "Green", "White", "Black"];
function remover(arr){
    let str = arr.join(",")
    str = str.replace(/,/g,"-")
    return str

}
console.log(remover(myColor))