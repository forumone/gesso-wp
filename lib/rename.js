/* eslint-env node */
/* eslint-disable no-console */

const inquirer = require('inquirer');
const path = require('path');
const fsPromises = require('fs/promises');

/**
 * Creates the machine name from a human-readable name.
 * @param {string} name - The human-readable name
 * @return {string} - The machine name
 */
function machineName(name) {
	return name.split(' ').join('-').toLowerCase();
}

/**
 * Creates a human name from a machine name.
 * @param {string} name - The machine name
 * @return {string} - The human-readable name
 */
function humanName(name) {
	const words = name
		.split('-')
		.map((word) => word.charAt(0).toUpperCase() + word.slice(1));
	return words.join(' ');
}

async function getNewName() {
	const question = [
		{
			type: 'input',
			name: 'themeName',
			message: 'What is the new name of your theme?',
			filter: machineName,
		},
	];
	const { pluginName } = await inquirer.prompt(question);
	return pluginName.trim();
}

async function getNewTitle(newName) {
	const questions = [
		{
			type: 'input',
			name: 'themeTitle',
			message: 'What is the new title of your theme?',
			default: humanName(newName),
		},
		{
			type: 'input',
			name: 'themeDescription',
			message: 'What is your theme description?',
			default: 'A collection of custom blocks',
		},
	];
	const { themeTitle, themeDescription } = await inquirer.prompt(questions);
	return [themeTitle.trim(), themeDescription.trim()];
}

async function searchAndReplace(
	file,
	currentDirectory,
	newName,
	newTitle,
	newDescription
) {
	const fileText = await fsPromises.readFile(
		path.join(currentDirectory, file),
		'utf-8'
	);
	const updatedText = fileText
		.replace(/gesso_/g, `${newName.replace(/-/g, '_')}_`)
		.replace(/gesso-wp/g, newName)
		.replace(/gesso/g, newName)
		.replace(/Gesso starter theme/g, newDescription)
		.replace(/Gesso/g, newTitle);
	return fsPromises.writeFile(file, updatedText);
}

async function updateReadMe(currentDirectory, newTitle) {
	const fileText = await fsPromises.readFile(
		path.join(currentDirectory, 'README.md'),
		'utf-8'
	);
	const updatedText = fileText
		.replace('Gesso for WordPress', newTitle)
		.replace('starter ', '');
	return fsPromises.writeFile(
		path.join(currentDirectory, 'README.md'),
		updatedText
	);
}

async function init() {
	const currentDirectory = process.cwd();
	const newName = await getNewName();
	const [newTitle, newDescription] = await getNewTitle(newName);
	const filesToUpdate = ['style.css', 'package.json'];
	const searches = filesToUpdate.map((file) =>
		searchAndReplace(
			file,
			currentDirectory,
			newName,
			newTitle,
			newDescription
		)
	);
	searches.push(updateReadMe(currentDirectory, newTitle));
	await Promise.all(searches);
	await fsPromises.rename(
		path.join(currentDirectory, 'blocks-plugin-template.php'),
		path.join(currentDirectory, `${newName}.php`)
	);
	await fsPromises.rename(
		currentDirectory,
		`${path.dirname(currentDirectory)}/${newName}`
	);
}

init().catch((err) => {
	console.error(err);
});
