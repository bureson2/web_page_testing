import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import pages.HomePage;
import pages.LoginPage;

import static org.junit.jupiter.api.Assertions.assertEquals;

public class TestLogin {
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
    public void testLogin(){
        HomePage homePage = new HomePage(webDriver);
        WebElement introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());

        LoginPage loginPage = homePage.clickLogin();
        WebElement signinTitle = loginPage.findSigninTitle();
        assertEquals("Sign In", signinTitle.getText());

        // neuspesne prihlaseni
        loginPage.clearInputs();
        loginPage.fillOutForm("Chereolenlka", "TS1adshoj!");
        loginPage.sendForm();
        signinTitle = loginPage.findSigninTitle();
        assertEquals("Sign In", signinTitle.getText());

        //uspesne prihlaseni

        loginPage.fillOutForm("Chereolenlka", "TS1ahoj!");
        loginPage.sendForm();
        introTitle = homePage.findIntroTitle();
        assertEquals("Welcome to\nMyPlant!", introTitle.getText());

        // logout
        homePage.logout();
        signinTitle = loginPage.findSigninTitle();
        assertEquals("Sign In", signinTitle.getText());
    }
}
