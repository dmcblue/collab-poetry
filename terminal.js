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
