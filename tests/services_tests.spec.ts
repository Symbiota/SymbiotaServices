import {test, expect} from '@playwright/test';

const baseURL = 'http://localhost:8000';

test.beforeEach(async ({ page }) => {
  await page.goto(`${baseURL}/login`);
  await page.getByLabel('Email').fill('mark.aaron.fisher@gmail.com');
  await page.getByLabel('Password').fill('password');
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