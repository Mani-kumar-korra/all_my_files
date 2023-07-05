
// Input: nums = [11,20,3,15], target = 18
// Output: [2,3]
// Explanation: Because nums[2] + nums[3] == 18, we return [2,3].


function findindex(nums,target){

    for(let i in nums){
        var val =nums[i]
        for(let j in nums)
        {
            if((val+nums[j]==target)){
                 return [i,j]
            }
        }


    }
    return ans
}
nums = [11,20,3,15], target = 18
console.log(findindex(nums,target))
