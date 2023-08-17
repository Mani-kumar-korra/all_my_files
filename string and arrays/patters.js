// pattern=""
// num =5
// for(let i =1;i<=num;i++){
//     for(let j =1;j<=num-i+1;j++){
//         pattern+= num-j+1
//     }
   
   

// pattern+='\n'
// }
// console.log(pattern)


pattern=""
num=5
for(let i =0;i<=num;i++){
    for(let j =0;j<num-i;j++){
        pattern+= " "
    }
    for(let k=0;k<i;k++){
    pattern+='* '
    }
    pattern+='\n'
}

console.log(pattern)