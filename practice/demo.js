let pattern =""
num=7
for(let i =0;i<num;i++){
    for(let j=0;j<num-1+1;j++){
        pattern+=i+1
    }
    pattern+='\n'
}
console.log(pattern)