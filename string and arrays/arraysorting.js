var arr1 = [0, -3, 8, 7, 6, 5, -4, 3, 2, 1 ]
// let arr2 = arr1.sort()
// console.log(arr2)


arr1.sort((a,b)=>{
    return a-b
});
console.log(arr1)