import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import pages.*;

import static org.junit.jupiter.api.Assertions.assertEquals;

public class TestCategory {
    static WebDriver webDriver;

    @BeforeAll
    public static void SetUp(){
        System.setProperty("webdriver.chrome.driver", "C:/Users/bures/OneDrive/Plocha/MyPlantSeleniumTest/src/main/resources/chromedriver.exe");
        webDriver = new ChromeDriver();
        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/");
    }

    @AfterAll
    public static void endTest(){
        webDriver.close();
    }

    @Test
    public void testAllCategoryIsFunctional(){

        HomePage homePage = new HomePage(webDriver);
        WebElement introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());

        homePage.clickLogin();
        LoginPage loginPage = homePage.clickLogin();
        WebElement signinTitle = loginPage.findSigninTitle();
        assertEquals("Sign In", signinTitle.getText());

        loginPage.fillOutForm("Chereolenlka", "TS1ahoj!");
        loginPage.sendForm();
        introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());

        CategoriesPage categoriesPage = homePage.clickCategories();
        WebElement elementTitle = categoriesPage.getMainTitle();
        assertEquals("Categories", elementTitle.getText());

        categoriesPage.getFertelizerCategory();
        elementTitle = categoriesPage.getTitle();
        assertEquals("Fertilizers", elementTitle.getText());
        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/categories");

        categoriesPage.getHousePlantsCategory();
        elementTitle = categoriesPage.getTitle();
        assertEquals("Houseplants", elementTitle.getText());
        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/categories");

        categoriesPage.getLifeHacksCategory();
        elementTitle = categoriesPage.getTitle();
        assertEquals("Lifehacks", elementTitle.getText());
        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/categories");

        categoriesPage.getPlantCareCategory();
        elementTitle = categoriesPage.getTitle();
        assertEquals("Plant care", elementTitle.getText());
        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/categories");

        categoriesPage.getPlantDiseaseCategory();
        elementTitle = categoriesPage.getTitle();
        assertEquals("Plant diseases", elementTitle.getText());
        webDriver.get("http://wa.toad.cz/~chereole/MyPlant/categories");
    }

    @Test
    public void testCreatePostAndFindItByCategory(){
        HomePage homePage = new HomePage(webDriver);
        WebElement introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());

        homePage.clickLogin();
        LoginPage loginPage = homePage.clickLogin();
        WebElement signinTitle = loginPage.findSigninTitle();
        assertEquals("Sign In", signinTitle.getText());

        loginPage.fillOutForm("Chereolenlka", "TS1ahoj!");
        loginPage.sendForm();
        introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());

        CreatePage createPage = homePage.clickCreate();
        WebElement createTitle = createPage.findCreateTitle();
        assertEquals("Create your post!", createTitle.getText());

        String postBody = "I love selenium";
        createPage.fillOutForm("Selenium", postBody, "Lifehacks");
        createPage.sendForm();
        PostsPage postsPage = new PostsPage(webDriver);
        WebElement postsTitle = postsPage.findPostsTitle();
        assertEquals("Latest Posts", postsTitle.getText());

        homePage.clickCategories();
        CategoriesPage categoriesPage = homePage.clickCategories();
        WebElement elementTitle = categoriesPage.getMainTitle();
        assertEquals("Categories", elementTitle.getText());

        categoriesPage.getLifeHacksCategory();
        elementTitle = categoriesPage.getTitle();
        assertEquals("Lifehacks", elementTitle.getText());

        PostsPage postPage = new PostsPage(webDriver);
        postPage.clickReadMore();

        SelectedPostPage selectedPostPage = new SelectedPostPage(webDriver);
        String lastPostBody = selectedPostPage.getLastElementBody().getText();
        assertEquals(postBody, lastPostBody);
    }
}
