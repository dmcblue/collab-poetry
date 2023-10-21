module.exports = {};

function error(msg, errorCode = 1) {
    console.log(msg);
    process.exit(errorCode);
}
module.exports.error = error;

function getArg(index, name = '', description = '') {
    name = name || `Argument ${index}`;
    description = description.length > 0 ? `: ${description}` : '';
    if (process.argv.length < index + 2) {
        error(`Missing argument '${name}'${description}`);
    }

    return process.argv[index + 2];
};
module.exports.getArg = getArg;

function randomInteger(min, max) {
    if (max === undefined) {
        max = min;
        min = 0;
    }

    return Math.floor(Math.random() * (max - min)) + min;
};
module.exports.randomInteger = randomInteger;

function randomizeArray(arr) {
    
}

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