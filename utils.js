module.exports = {};

function randomInteger(min, max) {
    if (max === undefined) {
        max = min;
        min = 0;
    }

    return Math.floor(Math.random() * (max - min)) + min;
};
module.exports.randomInteger = randomInteger;

function randomizeArray(arr) {
    const newArray = [];
    const indices = Object.keys(arr);
    while (indices.length > 0) {
        const i = randomInteger(indices.length);
        newArray.push(arr[indices[i]]);
        indices.splice(i, 1);
    }

    return newArray;
};
module.exports.randomizeArray = randomizeArray;

function randomOfArray(arr, excluding = []) {
    const newArr = arr.filter(item => !excluding.includes(item));
    // if (excluding.length > 0) {
    //     console.log('ARR', arr);
    //     console.log('EXC', excluding);
    //     console.log('FIL', newArr);
    // }
    if (newArr.length === 0) {
        throw 'Excluding too many elements';
    }

    const index = randomInteger(newArr.length);
    return newArr[index];
};
module.exports.randomOfArray = randomOfArray;

function randomProperty(obj, excluding = []) {
    const keys = Object.keys(obj);
    return randomOfArray(keys, excluding);
};
module.exports.randomProperty = randomProperty;

function uniq(arr) {
    const set = new Set();
    for(let item of arr) {
        set.add(item);
    }

    return Array.from(set);
};
module.exports.uniq = uniq;
