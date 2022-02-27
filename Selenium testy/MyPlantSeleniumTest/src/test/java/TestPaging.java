import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import pages.HomePage;
import pages.LoginPage;
import pages.PostsPage;

import static org.junit.jupiter.api.Assertions.assertEquals;

public class TestPaging {
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
    public void testPaging(){
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

        PostsPage postsPage = homePage.clickPosts();
        postsPage.clickLastPage();
        assertEquals(true, postsPage.isFirstOnPage());
        assertEquals(false, postsPage.isLastOnPage());

        postsPage.countArticles();
        assertEquals(35, postsPage.countArticles());

        postsPage.clickFirstPage();
        assertEquals(true, postsPage.isLastOnPage());
        assertEquals(false, postsPage.isFirstOnPage());
    }
}
