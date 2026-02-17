import {test, expect} from '@playwright/test';

const baseURL = 'http://localhost:8000';
const userEmail = 'TODO add user email';
const userPassword = 'TODO add user password';

test.beforeEach(async ({ page }) => {
  await page.goto(`${baseURL}/login`);
  await page.getByLabel('Email').fill(userEmail);
  await page.getByLabel('Password').fill(userPassword);
  await page.getByRole('button', { name: 'Log In' }).click();
});


test.describe('Services Tests', () => {
  test('should display the services page', async ({page}) => {
    const resp = await page.goto(`${baseURL}/services`, { waitUntil: 'domcontentloaded' });
    console.log('status', resp?.status(), 'url', page.url());
    await expect(page).toHaveURL(/\/services/);

    await expect(page.getByRole('link', { name: 'Create Service' })).toBeVisible();
    await expect(page.getByRole('heading', { name: 'Services' })).toBeVisible();
  });
});