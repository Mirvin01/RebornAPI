const fs = require('fs');

const json = fs.readFileSync('sound_definitions.json');
const data = JSON.parse(json);

let soundType = '';

for (const key in data) {
  const value = data[key];
  const constantName = key.toUpperCase().replace(/\./g, '_');
  const constantSoundType = `    public const ${constantName} = "${key}";\n`;
  soundType += constantSoundType;
}

const phpClass = `<?php\n\nclass SoundType{\n${soundType}\n}\n`;

fs.writeFile('SoundType.php', phpClass, (err) => {
  if (err) throw err;
  console.log('SoundType.php file has been saved.');
});