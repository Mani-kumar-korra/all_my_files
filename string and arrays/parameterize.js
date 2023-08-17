function para(str){
    let para1 = str.toLowerCase()
    let para2 = para1.replace(/ /g,"-")
    return para2
}
console.log(para("Robin Singh from USA."))