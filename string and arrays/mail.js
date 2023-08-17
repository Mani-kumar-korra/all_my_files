function hidden(str){
    let splitted = str.split("@")
    let part1 =splitted[0]
    let domain =splitted[1]
    
    return part1.substring(0,4)+"..."+"@"+domain
}
console.log(hidden("mani_kumar@gmail.com"))