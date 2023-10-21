const rhymes = require('./rhymes');
const utils = require('./utils');
const RHYME_SCHEME = require('./rhyme-scheme');

function getRhyme(excluding = []) {
    return utils.randomProperty(rhymes, excluding);
}

function createRhymeChunk(schemeType, exclude = []) {
    // assume 4?
    let rhyme1, rhyme2;
    if (schemeType === RHYME_SCHEME.RANDOM) {
        schemeType = utils.randomProperty(RHYME_SCHEME, [RHYME_SCHEME.RANDOM]);
    }
    switch(schemeType) {
        case RHYME_SCHEME.ABAB:
            rhyme1 = getRhyme(exclude);
            rhyme2 = getRhyme([...exclude, rhyme1]);
            return [rhyme1, rhyme2, rhyme1, rhyme2];
        default: // RHYME_SCHEME.PAIR
            rhyme1 = getRhyme(exclude);
            rhyme2 = getRhyme([...exclude, rhyme1]);
            return [rhyme1, rhyme1, rhyme2, rhyme2];
    }
}

function createScheme(schemeType, lineCount) {
    let linesLeft = lineCount;
    const lines = [];
    let rhymeChunk = [];
    while(linesLeft > 3) {
        rhymeChunk = createRhymeChunk(schemeType, utils.uniq(rhymeChunk));
        for (let rhyme of rhymeChunk) {
            lines.push(rhyme);
        }
        linesLeft -= rhymeChunk.length;
    }

    // heroic couplet / PAIRS
    const rhyme = getRhyme(utils.uniq(rhymeChunk));
    while (linesLeft > 0) {
        lines.push(rhyme);
        linesLeft -= 1;
    }

    return lines;
}

// want everyone to have equal # of lines,
// but not necessarily equal # of lines per poem?
// >> Why not? People should feel like equal participants
function createExercise(collabCount, themes) {
    const worksCount = themes.length;
    const works = [];

    for (let i = 0; i < worksCount; i++) {
        const lineCount = collabCount * utils.randomInteger(1, 4);
        const schemeType = utils.randomProperty(RHYME_SCHEME);
        const syllablesLowerBound = utils.randomInteger(4, 9);
        const syllablesUpperBound = syllablesLowerBound + 3; //utils.randomInteger(syllablesLowerBound + 3, 16);
        const syllablesRange = [syllablesLowerBound, syllablesUpperBound];
        works.push({
            subject: themes[i],
            lineCount: lineCount,
            syllablesRange: syllablesRange,
            scheme: createScheme(schemeType, lineCount),
            schemeType: schemeType
        });
    }

    let i = 1;
    const lines = [];
    for (let work of works) {
        for (let rhyme of work.scheme) {
            lines.push({
                id: i,
                theme: work.subject,
                range: `${work.syllablesRange[0]} - ${work.syllablesRange[1]}`,
                rhyme: rhyme
            });
            i++;
        }
    }

    // so now we have it on a per poem basis, we have to
    // make each line an object and round-robin the objects
    // to each person. Then randomize order per person?

    const collabs = [];
    for (let i = 0; i < collabCount; i++) {
        collabs[i] = [];
    }

    i = 0;
    for (let line of lines) {
        collabs[i].push(line);
        i = (i + 1) % collabCount;
    }

    for (let i = 0, ilen = collabs.length; i < ilen; i++) {
        collabs[i] = utils.randomizeArray(collabs[i]);
    }

    return [works, collabs];
}
module.exports.createExercise = createExercise;
